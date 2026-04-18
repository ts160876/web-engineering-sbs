<?php

namespace Bukubuku\Core\Exception;

class InternalErrorException extends \Exception
{
    protected $message = 'Internal Server Error';
    protected $code = 500;
}
