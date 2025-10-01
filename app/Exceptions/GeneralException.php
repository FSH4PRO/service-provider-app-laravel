<?php

namespace App\Exceptions;

use Exception;

class GeneralException extends Exception
{
    protected $code;
    protected $message;
    public function __construct($message = 'general exception', $code = 500){
        $this->code = $code;
        $this->message = $message;
    }

    }

