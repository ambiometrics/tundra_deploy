<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

use edwrodrig\qt_app_builder\util\Util;
use Exception;

/**
 * Class SourcesToolsInstallToDirScript
 * This script install the retrieved scripts to the target directory
 * @package edwrodrig\qt_app_builder\variable
 */
class SourcesToolsInstallToDirScript  extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Tools install to dir script";
    }

    public function find(): bool
    {
        $toolsDirectory = Variables::SourcesToolsDirectory()->get();
        $installToDirScript = $toolsDirectory . '/02.install_to_dir.php';

        if ( !file_exists($installToDirScript) )
            $this->throwNotFound("Your project does not have a install to dir script");

        if ( !Util::testPhpScript($installToDirScript) )
            $this->throwNotFound(sprintf("The script has a syntax error [%s]", $installToDirScript));

        $this->value = $installToDirScript;

        $this->printFound();
        return true;
    }

    public function installToDeployDirectory() : bool {
        $script = Variables::SourcesToolsInstallToDirScript()->get();
        $target = Variables::DeployDirectory()->get();
        printf("Installing apps to [%s]...\n", $target);
        $command = sprintf("%s %s", $script, $target);
        if ( ! Util::runPhpScript($command) ) {
            throw new Exception(sprintf("Error installing apps in deploy folder [%s]", $script));
        }
        printf("Apps INSTALLED!\n");
        return true;
    }
}
