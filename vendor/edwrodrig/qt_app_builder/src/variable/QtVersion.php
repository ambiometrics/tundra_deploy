<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class QtVersion
 * Variable that hold the Qt version.
 * This is useful to determine the {@see QtVersionDirectory}
 * @package edwrodrig\qt_app_builder\variable
 */
class QtVersion extends Variable
{
    public function getVariableName(): string
    {
        return "Qt version directory";
    }

    public function find() : bool {
        $os = Variables::OperativeSystem()->get();
        if ( $os === 'linux' ) {
            $this->value = "5.13.0";
        } else if ( $os === "windows nt" ) {
            $this->value = "5.12.6";
        } else {
            $this->throwNotFound("NOT IMPLEMENTED FOR THIS OS");
            return false;
        }

        $this->printFound();
        return true;
    }
}
