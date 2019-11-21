<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class QtVersionDirectory
 * Variable that hold the Qt installation directory for a version.
 * A Qt directory can have multiple version installed so it's useful to specify the correct one
 * @package edwrodrig\qt_app_builder\variable
 */
class QtVersionDirectory extends Variable
{
    public function getVariableName(): string
    {
        return "Qt version directory";
    }

    public function find() : bool {
        $qtVersion = Variables::QtVersion()->get();
        $qtDirectory = Variables::QtDirectory()->get();
        $qtVersionDirectory = $qtDirectory . "/" . $qtVersion;

        if ( !is_dir($qtVersionDirectory) ) {
            $this->throwNotFound("You must install Qt in a available way");
        }
        $this->value = $qtVersionDirectory;
        $this->printFound();
        return true;
    }
}
