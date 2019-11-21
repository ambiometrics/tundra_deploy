<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\util;

class Util
{
    /**
     * Get the directory of the script calling this function
     * @return string
     */
    public static function getExecutionDirectory() : string {
        $backtrace = debug_backtrace();
        $count = count($backtrace);
        $lastCaller = $backtrace[$count - 1];
        $lastCallerFile = $lastCaller['file'];
        $lastCallerFileDir = dirname($lastCallerFile);
        return $lastCallerFileDir;
    }
}