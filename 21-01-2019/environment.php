<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */

 define('APP_ENV', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');


/**
 * DB Credentials ...
 * Set DB details a/c to your configuration.
 *
 */
 define('DB_HOST'		, 'localhost');
 define('DB_NAME'		, 'daysgo_db');
 define('DB_USER'		, 'daysgo_admin');
 define('DB_PASSWORD'	, 'db_P@$$w0rd');
 define('DB_DRIVER'		, 'mysqli');
 define('DB_PREFIX'		, 'pre_');
 define('H_PROTOCOL'	, 'https://');






