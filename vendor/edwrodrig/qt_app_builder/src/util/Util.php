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

    public static function testPhpScript($script) : bool {
        $testCommand = 'php -l ' . $script;
        printf("Testing script with [%s]...\n", $testCommand);
        exec($testCommand , $output, $return);
        return $return === 0;
    }

    public static function runPhpScript($script) : bool {
        $runCommand = 'php ' . $script;
        printf("Executing script with [%s]...\n", $runCommand);
        passthru($runCommand,$return);
        return $return === 0;
    }
}