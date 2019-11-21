<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class Compiler
 * Variable that hold the Qt compiler name.
 * This is useful to determine the {@see QtCompilerDir}
 * @package edwrodrig\qt_app_builder\variable
 */
class Compiler extends Variable
{
    public function getVariableName(): string
    {
        return "Compiler";
    }

    public function find() : bool {
        $os = Variables::OperativeSystem()->get();
        if ( $os === 'linux' ) {
            $this->value = "gcc_64";
        } else if ( $os === "windows nt" ) {
            $this->value = "mingw73_64";
        } else {
            $this->throwNotFound("NOT IMPLEMENTED FOR THIS OS");
            return false;
        }

        $this->printFound();
        return true;
    }
}
