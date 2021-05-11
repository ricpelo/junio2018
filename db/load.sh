#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U junio2018 -d junio2018 < $BASE_DIR/junio2018.sql
    if [ -f "$BASE_DIR/junio2018_test.sql" ]; then
        psql -h localhost -U junio2018 -d junio2018 < $BASE_DIR/junio2018_test.sql
    fi
    echo "DROP TABLE IF EXISTS migration CASCADE;" | psql -h localhost -U junio2018 -d junio2018
fi
psql -h localhost -U junio2018 -d junio2018_test < $BASE_DIR/junio2018.sql
echo "DROP TABLE IF EXISTS migration CASCADE;" | psql -h localhost -U junio2018 -d junio2018_test
