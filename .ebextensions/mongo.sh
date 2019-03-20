#!/bin/bash
if \[ ! -f /tmp/mongoinstalled.txt \];
then
  sudo cp -a /etc/php-7.0.ini /etc/php-7.0.ini.bak
  sudo pecl7 install mongodb
  sudo echo "mongo extension installed" | sudo tee /tmp/mongoinstalled.txt
  sudo cp -a /etc/php-7.0.ini.bak /etc/php-7.0.ini
  sudo echo "extension=mongodb.so" | sudo tee /etc/php-7.0.d/90-mongodb.ini
  sudo service httpd restart
fi