<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Exceptions;

/**
 * Description of DriblyApiModelException
 *
 * @author toby
 */
class DriblyApiModelException extends DriblyApiException {
    //put your code here
    protected $fieldErrors = [];
    
    public function __construct($code, $errors, $fieldErrors, \Throwable $previous = null)
    {
        parent::__construct($code, $errors, $previous);
        $this->fieldErrors = $fieldErrors;
        
    }
    public function getFieldError($fieldName)
    {
        return (array_key_exists($fieldName, $this->fieldErrors) ? $this->fieldErrors[$fieldName] : null);
    }
    
    public function __toString() {
        $message = "";
        foreach ($this->fieldErrors as $fieldName => $error)
        {
            $message .= ", (" . $fieldName . " - " . $error;
        }
        return parent::__toString() . $message;
    }
}
