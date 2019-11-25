<?php
declare(strict_types=1);


namespace edwrodrig\qt_app_builder\variable;

/**
 * Class SourcesToolsDirectory
 * Sources  Tools directory is where the tools of the application should go.
 * Tools are applications of files needed by your main project. Like executables or database files.
 * Tools folder is optional in a project.
 * You must use this with {@see Variable::tryToFind()}
 * @package edwrodrig\qt_app_builder\variable
 */
class SourcesToolsDirectory extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Sources Tools directory";
    }

    public function find() : bool {
        $sourcesToolsDirectory = Variables::SourcesDirectory()->get() . "/tools";

        if ( !is_dir($sourcesToolsDirectory) ) {
            $this->throwNotFound("You must have a tools directory");
        }
        $this->value = $sourcesToolsDirectory;
        $this->printFound();

        return true;
    }
}