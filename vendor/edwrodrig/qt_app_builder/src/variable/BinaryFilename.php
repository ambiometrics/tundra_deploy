<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class BinaryFilename
 * The Binary filename is the executable filename that is the result of the compilation.
 * The directory must be set with the {@see BuildDirectory::set() set method), in windows do not put the .exe extension
 * @package edwrodrig\qt_app_builder\variable
 */
class BinaryFilename  extends Variable
{
    /**
     * Get the variable name.
     *
     * This name is used for logs an error messages
     * @return string
     */
    public function getVariableName(): string
    {
        return "Binary filename";
    }

    public function find(): bool
    {
        $binaryFilename = Variables::BuilderConfiguration()->getValue("binary_filename");
        if (is_null($binaryFilename))
            $this->throwNotFound("You must set a binary filename in the config file. Use key 'binary_filename'");

        $this->value = $binaryFilename;

        if (Variables::OperativeSystem()->get() === "windows nt")
            $this->value .= ".exe";

        $this->printFound();
        return true;

    }
}
