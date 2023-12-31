<?php

class PHPExcel_Exception extends Exception {
    /**
     * Error handler callback
     *
     * @param mixed $code
     * @param mixed $string
     * @param mixed $file
     * @param mixed $line
     * @param mixed $context
     */
    public static function errorHandlerCallback($code, $string, $file, $line, $context) {
        $e = new self($string, $code);
        $e->line = $line;
        $e->file = $file;
        throw $e;
    }
}
