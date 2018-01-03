<?php
/**
 * Arquivo que contém todas as variaveis de ambiente que o sistema precisa
 */
if (empty(getenv('DB_NAME'))) {
    putenv('DB_TYPE=mysql');
    putenv('DB_NAME=');
    putenv('DB_HOST=');
    putenv('DB_USER=');
    putenv('DB_PASS=');
    putenv('DB_PORT=3306');
}