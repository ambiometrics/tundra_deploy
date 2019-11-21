<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class ProjectFilename
 * The Binary filename is the executable filename that is the result of the compilation.
 * @package edwrodrig\qt_app_builder\variable
 */
class ProjectFilename  extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Project filename";
    }

    public function find(): bool
    {
        $projectFilename = Variables::BuilderConfiguration()->getValue("project_filename");
        if (is_null($projectFilename))
            $this->throwNotFound("You must set a qt project filename (.pro) in the config file. Use key 'project_filename'");

        $this->value = $projectFilename;

        $this->printFound();
        return true;

    }
}
