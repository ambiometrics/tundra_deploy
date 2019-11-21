<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

use Exception;

/**
 * Class Git
 *
 * The makefile command executable.
 * @package edwrodrig\qt_app_builder\variable
 */
class Git extends Variable
{

    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Git";
    }

    public function find() : bool {
        $git = "git";

        exec($git . " --version", $output, $return);
        if ( $return != 0 )
            $this->throwNotFound(sprintf("Git does not work [%s]", $git));

        $this->value = $git;
        $this->printFound();
        return true;
    }

    /**
     * Calling Make
     * You do not need to pass variables
     * @param string $repoUrl
     * @return bool
     * @throws VariableNotFoundException
     */
    public function clone() : bool {
        $git = Variables::Git()->get();
        $repoUrl = Variables::Repository()->get();

        printf("Cloning with git...\n");
        $command = sprintf("%s clone %s sources", $git, $repoUrl);
        printf("Command to execute [%s]\n", $command);

        passthru($command, $return_var);

        if ( $return_var != 0 ) {
            throw new Exception(sprintf("Error cloning repository\n"));
        }
        return true;
    }
}
