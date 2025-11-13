#!/bin/bash 

PGPASSWORD=admin pg_dump -U admin -h localhost -d my_db --schema-only > dump
