#!/usr/bin/env bash

#Install symfony installer
mkdir -p /usr/local/bin
curl -LsS https://symfony.com/installer -o /usr/local/bin/symfony
chmod a+x /usr/local/bin/symfony

symfony new symfony_project 3.4

mv symfony_project/* .

rm -rf symfony_project

echo "/var" >> .gitignore
