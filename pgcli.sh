#!/bin/bash
PGPASSWORD=db_password pgcli -h localhost -p 5432 -U db_user -w -d postgres
