<?php

namespace Bukubuku\Core\Exception;

class DatabaseException extends \Exception
{
    protected $message = 'Database Error';
    protected $code = 500;
}
