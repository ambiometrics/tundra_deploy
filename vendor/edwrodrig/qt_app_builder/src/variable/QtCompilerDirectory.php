<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\variable;

/**
 * Class QtCompilerDirectory
 * Variable that hold the Qt installation directory for a compiler in a version.
 * A Qt version directory can have multiple compilers installed so it's useful to specify the correct one
 * @package edwrodrig\qt_app_builder\variable
 */
class QtCompilerDirectory extends Variable
{
    public function getVariableName(): string
    {
        return "Qt compiler directory";
    }

    public function find() : bool {
        $qtVersionDirectory = Variables::QtVersionDirectory()->get();
        $compiler = Variables::Compiler()->get();
        $qtCompilerDirectory = $qtVersionDirectory . "/" . $compiler;

        if ( !is_dir($qtCompilerDirectory) ) {
            $this->throwNotFound("You must install Qt in a available way");
        }
        $this->value = $qtCompilerDirectory;
        $this->printFound();
        return true;
    }
}
