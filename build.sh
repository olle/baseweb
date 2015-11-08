#!/bin/sh
# @author  Olle Törnström olle@studiomediatech.com
# @created 2009-05-13
# @since   2.0

# Invoke ant builder
ant $1 $2

# If any other target than default, we clean modules.
if [ -n $2 ]; then
    for LINE in `php build.php`; do
        rm -rf $LINE
    done
fi
