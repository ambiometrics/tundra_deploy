<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class QtDirectory
 * Variable that hold the Qt installation directory
 * @package edwrodrig\qt_app_builder\variable
 */
class QtDirectory extends Variable
{
    public function getVariableName(): string
    {
        return "Qt version directory";
    }

    public function find() : bool {
        $os = Variables::OperativeSystem()->get();
        $qtDirectory = null;
        if ( $os === 'linux' ) {
            $homeDirectory = Variables::HomeDirectory()->get();
            $qtDirectory = $homeDirectory . "/Qt";
        } else if ( $os === "windows nt" ) {
            $qtDirectory = "c:/Qt";
        } else {
            $this->throwNotFound("You must install Qt in a available way");
            return false;
        }
        if ( !is_dir($qtDirectory) ) {
            $this->throwNotFound("You must install Qt in a available way");
        }
        $this->value = $qtDirectory;
        $this->printFound();
        return true;
    }
}
