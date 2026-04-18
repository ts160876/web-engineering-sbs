<?php

namespace Bukubuku\Core\Exception;

class NotAuthorizedException extends \Exception
{
    protected $message = 'Not authorized';
    protected $code = 403;
}
