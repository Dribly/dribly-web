<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Exceptions;

/**
 * Description of DriblyApiException
 *
 * @author toby
 */
class DriblyApiException extends \Exception {
    //put your code here
    protected $errors = [];
    
    public function __construct($code, $errors,\Throwable $previous = null)
    {
        parent::__construct("Error at API", $code, $previous);
        $this->errors = $errors;
        
    }
    public function __toString() {
        return $this->getMessage . ": " . implode(", ", $this->errors);
    }
}
