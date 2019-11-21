<?php
declare(strict_types=1);


namespace edwrodrig\qt_app_builder\variable;

/**
 * Class BuilderConfigurationFilename
 * Builder configuration filename is where the qmake script will do their stuff.
 * Use the {@see CompilationDirectory::set() set method} to prepare the compilation directory, deleting if there is a current one.
 * @package edwrodrig\qt_app_builder\variable
 */
class BuilderConfiguration extends Variable
{

    private $values = [];
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Builder configuration file";
    }

    public function find() : bool {
        $configurationFilename = Variables::BuildDirectory()->get() . "/config.json";

        if ( !file_exists($configurationFilename) ) {
            $this->throwNotFound("You must create a config file");
        }

        $contents = file_get_contents($configurationFilename);
        $json_values = json_decode($contents, true);
        if ( $json_values === FALSE ) {
            $this->throwNotFound("The file must be a valid json file");
        }

        $this->values = $json_values;

        $this->value = $configurationFilename;
        $this->printFound();

        return true;
    }

    public function getValue(string $key) : ?string {
        $this->find();
        return $this->values[$key] ?? null;
    }
}