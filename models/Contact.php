<?php

namespace Bukubuku\Models;

use Bukubuku\Core\Model;
use Bukubuku\Core\Rule;

class Contact extends Model
{
    public string $subject = '';
    public string $email = '';
    public string $message = '';

    static protected function getRulesets(): array
    {
        return [
            'subject' => [
                Rule::REQUIRED => [],
            ],
            'email' => [
                Rule::REQUIRED => [],
                Rule::EMAIL => []
            ],
            'message' => [
                Rule::REQUIRED => [],
            ]
        ];
    }

    static protected function propertyMapping(): array
    {
        return [
            'subject' => 'Subject',
            'email' => 'E-Mail',
            'message' => 'Message',
        ];
    }

    public function process(): bool
    {
        //Simulate an error :-)
        if ($this->subject != 'Send an error') {
            return true;
        } else {
            return false;
        }
    }
}
