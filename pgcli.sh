#!/bin/bash
HOST=localhost
USER=admin
PASSWORD=admin
PORT=5432
DB=my_db
PGPASSWORD="$PASSWORD" pgcli -h "$HOST" -p $PORT -U "$USER" -w -d "$DB"
