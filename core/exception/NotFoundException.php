<?php

namespace Bukubuku\Core\Exception;

class NotFoundException extends \Exception
{
    protected $message = 'Not found';
    protected $code = 400;
}
