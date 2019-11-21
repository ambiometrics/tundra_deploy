<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class Repository
 * THold the git repository to download
 * @package edwrodrig\qt_app_builder\variable
 */
class Repository  extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Repository";
    }

    public function find(): bool
    {
        $repository = Variables::BuilderConfiguration()->getValue("repository");
        if (is_null($repository))
            $this->throwNotFound("You must set a git repository in the config file. Use key 'repository'");

        $this->value = $repository;


        $this->printFound();
        return true;

    }
}
