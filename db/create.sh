#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE junio2018_test;"
    psql -U postgres -c "CREATE USER junio2018 PASSWORD 'junio2018' SUPERUSER;"
else
    [ "$1" = "test" ] || sudo -u postgres dropdb --if-exists junio2018
    sudo -u postgres dropdb --if-exists junio2018_test
    [ "$1" = "test" ] || sudo -u postgres dropuser --if-exists junio2018
    [ "$1" = "test" ] || sudo -u postgres psql -c "CREATE USER junio2018 PASSWORD 'junio2018' SUPERUSER;"
    [ "$1" = "test" ] || sudo -u postgres createdb -O junio2018 junio2018
    [ "$1" = "test" ] || sudo -u postgres psql -d junio2018 -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O junio2018 junio2018_test
    sudo -u postgres psql -d junio2018_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    [ "$1" = "test" ] && exit
    LINE="localhost:5432:*:junio2018:junio2018"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
