#!/bin/sh

[ "$1" = "test" ] && BD="_test"
psql -h localhost -U junio2018 -d junio2018$BD
