#!/bin/bash

#reduce image size via command line;



# PLEASE INSTALL IMAGETICK FIRST USING COMMAND :apt-get install php-imagick
# Verify if imagick has been loaded as an extension : php -m | grep imagick

# where coinsence is installed
export HOME_DIR=/var/www/test
# PATH of the IMAGES file
export IMAGES_DIR=humhub/
# max size 
export MAX_SIZE=30k
# reduce the size to 30%
export CONVERSION_RATE=30%

find $HOME_DIR/$IMAGES_DIR humhub/themes/Coinsence/img/test/ -type f -size +$MAX_SIZE -exec convert -resize $CONVERSION_RATE {} {} \;





