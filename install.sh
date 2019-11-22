#!/bin/bash

echo "Prepare folder..."
rm -rf vendor

echo "Download composer..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

echo "Install dependecies..."
./composer.phar install --no-dev

echo "Preparing folder..."

rm -rf \
  vendor/edwrodrig/qt_app_builder/.gitignore \
  vendor/edwrodrig/qt_app_builder/.idea \
  vendor/edwrodrig/qt_app_builder/composer.json \
  vendor/edwrodrig/qt_app_builder/examples \
  vendor/edwrodrig/qt_app_builder/legacy \
  vendor/edwrodrig/qt_app_builder/phpunit.xml.dist \
  vendor/edwrodrig/qt_app_builder/README.md \
  vendor/edwrodrig/qt_app_builder/tests \
  vendor/edwrodrig/qt_app_builder/.git \
  composer.lock \
  composer.phar

echo "Done!!"

