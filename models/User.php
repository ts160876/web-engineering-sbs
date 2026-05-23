<?php

namespace Bukubuku\Models;

use Bukubuku\Core\DatabaseModel;
use Bukubuku\Core\Rule;


class User extends DatabaseModel
{
    //Properties of the model
    public int $userId = 0;
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public string $password = '';
    //The UI needs a second field to confirm the password.
    public string $confirmPassword = '';
    //And a boolean is treated as TINYINT by MySQL.
    public int $isAdmin = 0;

    static protected function getTableName(): string
    {
        return 'users';
    }

    static protected function getPrimaryKeyName(): string
    {
        return 'user_id';
    }

    static protected function columnMapping(): array
    {
        return [
            'user_id' => 'userId',
            'first_name' => 'firstName',
            'last_name' => 'lastName',
            'email' => 'email',
            'pwd' => 'password',
            'is_admin' => 'isAdmin',
        ];
    }

    static protected function getRulesets(): array
    {
        return [
            'firstName' => [
                Rule::REQUIRED => []
            ],
            'lastName' => [
                Rule::REQUIRED => []
            ],
            'email' => [
                Rule::REQUIRED => [],
                Rule::EMAIL => []
            ],
            'password' => [
                Rule::REQUIRED => []
            ],
            'confirmPassword' => [
                Rule::REQUIRED => []
            ]
        ];
    }

    static protected function propertyMapping(): array
    {
        return [
            'userId' => 'User ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'email' => 'E-Mail',
            'password' => 'Password',
            'confirmPassword' => 'Confirm Password',
            'isAdmin' => 'User Role'
        ];
    }
}
