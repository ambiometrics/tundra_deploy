<?php
declare(strict_types=1);

namespace edwrodrig\qt_app_builder\process;

use edwrodrig\qt_app_builder\variable\VariableNotFoundException;
use edwrodrig\qt_app_builder\variable\Variables;

class Step
{
    /**
     * A default generic retrieve sources step
     * @throws \edwrodrig\qt_app_builder\variable\VariableNotFoundException
     */
    public static function getSources()
    {
        try {
            Variables::BuildDirectory()->find();
            Variables::BuilderConfiguration()->find();
            Variables::SourcesDirectory()->set();
            Variables::Git()->find();

            Variables::Git()->clone();

            printf("GET SOURCES SUCCEEDED!\n");
        } catch (VariableNotFoundException $exception) {
            fprintf(STDERR, "%s [%s]", $exception->getMessage(), $exception->getRecoverMessage());
        }
    }

    /**
     * A default generic compile step
     * @throws \edwrodrig\qt_app_builder\variable\VariableNotFoundException
     */
    public static function Compile() {
        try {
            Variables::BuildDirectory()->find();
            Variables::SourcesDirectory()->find();
            Variables::CompilationDirectory()->set();
            Variables::OperativeSystem()->find();
            Variables::QtVersionDirectory()->find();
            Variables::QMake()->find();
            Variables::Make()->find();

            Variables::Qmake()->call();
            Variables::Make()->call();

            printf("COMPILE SUCCEEDED!\n");
        } catch ( VariableNotFoundException $exception ) {
            fprintf(STDERR, "%s [%s]", $exception->getMessage(), $exception->getRecoverMessage());
        }

    }

    /**
     * A default generic get dependencies step.
     * It is recomended to do after Deploy
     * @throws \edwrodrig\qt_app_builder\variable\VariableNotFoundException
     */
    public static function GetDependencies() {
        try {
            Variables::BuildDirectory()->find();
            Variables::SourcesDirectory()->find();
            Variables::OperativeSystem()->find();
            if ( Variables::SourcesToolsGetAppsScript()->tryToFind()  ) {
                Variables::SourcesToolsGetAppsScript()->getApps();
            }
            printf("GET DEPENDENCIES SUCCEEDED!\n");
        } catch ( VariableNotFoundException $exception ) {
            fprintf(STDERR, "%s [%s]", $exception->getMessage(), $exception->getRecoverMessage());
        }
    }

    /**
     * A default generic deploy step
     * @throws \edwrodrig\qt_app_builder\variable\VariableNotFoundException
     */
    public static function Deploy() {
        try {
            Variables::BuildDirectory()->find();
            Variables::CompilationDirectory()->find();
            Variables::OperativeSystem()->find();
            Variables::QtVersionDirectory()->find();

            Variables::DeployDirectory()->set();
            Variables::DeployDirectory()->find();
            Variables::BinaryCompilationFilepath()->copyToDeployDirectory();
            Variables::BinaryDeployFilepath()->changeModeToExecutable();

            Variables::QtDeploy()->call();

            if ( Variables::SourcesToolsInstallToDirScript()->tryToFind()  ) {
                Variables::SourcesToolsInstallToDirScript()->installToDeployDirectory();
            }

            printf("DEPLOY SUCCEEDED!\n");

        } catch ( VariableNotFoundException $exception ) {
            fprintf(STDERR, "%s [%s]", $exception->getMessage(), $exception->getRecoverMessage());
        }
    }
}