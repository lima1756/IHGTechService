<?php

    /**
     * setReporting
     * Revisa si el ambiente esta implementado y revisa errores
     * @return void
     */
    function serReporting() 
    {
        if (DEVELOPMENT_ENVIRONMENT == true) 
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } 
        else 
        {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
        }
    }

    /**
     * stripSlashesDeep
     * Revisa por comillas magicas y las elimina
     * @param String $value
     * @return String
     */
    function stripSlashesDeep($value)
    {
        $value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
        return $value;
    }