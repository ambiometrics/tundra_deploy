<?php
declare(strict_types=1);


namespace edwrodrig\qt_app_builder\variable;

/**
 * Class SourcesDirectory
 * Sources directory is where the code should go.
 * Use the {@see SourcesDirectory::set() set method} to prepare the source directory, deleting if there is a current one.
 * @package edwrodrig\qt_app_builder\variable
 */
class SourcesDirectory extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Sources directory";
    }

    public function find() : bool {
        $sourcesDirectory = Variables::BuildDirectory()->get() . "/sources";

        if ( !is_dir($sourcesDirectory) ) {
            $this->throwNotFound("You must clone your your Qt project");
        }
        $this->value = $sourcesDirectory;
        $this->printFound();

        return true;
    }

    /**
     * Set a sources directory.
     * If exists then clean with rf command
     * @throws VariableNotFoundException
     */
    public function set() {
        $sourcesDirectory = Variables::BuildDirectory()->get() . "/sources";
        if ( is_dir($sourcesDirectory) ) {
            printf("Old Sources directory FOUND at [%s]...removing!\n", $sourcesDirectory);
            passthru(sprintf("rm -rf %s", $sourcesDirectory));
        }
    }
}