<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

use edwrodrig\qt_app_builder\util\Util;
use Exception;

/**
 * Class SourcesToolsGetAppsScript
 * The Sources Tools Get Apps Script filename is a script that retrieve the tools nedded to application to work
 * @package edwrodrig\qt_app_builder\variable
 */
class SourcesToolsGetAppsScript  extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Tools get apps script";
    }

    public function find(): bool
    {
        $toolsDirectory = Variables::SourcesToolsDirectory()->get();
        $getAppScript = $toolsDirectory . '/01.get_apps.php';

        if ( !file_exists($getAppScript) )
            $this->throwNotFound("Your project does not have a get apps script");

        if ( !Util::testPhpScript($getAppScript) )
            $this->throwNotFound(sprintf("The script has a syntax error [%s]", $getAppScript));

        $this->value = $getAppScript;

        $this->printFound();
        return true;

    }

    public function getApps() : bool {
        $script = Variables::SourcesToolsGetAppsScript()->get();
        printf("Getting apps...\n");
        if ( ! Util::runPhpScript($script) ) {
            throw new Exception(sprintf("Error at getting apps [%s]", $script));
        }
        printf("Apps RETRIEVED!\n");
        return true;
    }
}
