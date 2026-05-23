<?php

namespace Bukubuku\Models;

use Bukubuku\Core\DatabaseModel;
use Bukubuku\Core\Rule;
use Bukubuku\Core\RuleParameter;

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
    //The database needs to store the password hash.
    public string $hashedPassword = '';
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
            'pwd' => 'hashedPassword',
            'is_admin' => 'isAdmin',
        ];
    }

    static protected function getRulesets(): array
    {
        return [
            'firstName' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'lastName' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'email' => [
                Rule::REQUIRED => [],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100],
                Rule::EMAIL => [],
                Rule::UNIQUE => []
            ],
            'password' => [
                Rule::REQUIRED => [],
                //To allow easier testing, we allow very short passwords.
                Rule::MIN_LENGTH => [RuleParameter::MIN => 3],
                Rule::MAX_LENGTH => [RuleParameter::MAX => 100]
            ],
            'confirmPassword' => [
                Rule::REQUIRED => [],
                Rule::MATCH => [RuleParameter::MATCH => 'password']
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

    static public function getIsAdminDropdown(): array
    {
        return [
            0 => 'Customer',
            1 => 'Administrator'
        ];
    }

    public function insert(): bool
    {
        //We need to hash the password.
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::insert();
    }

    public function update(array $properties = []): bool
    {
        //We need to hash the password.
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::update($properties);
    }

    public function checkPassword($password): bool
    {
        if (password_verify($password, $this->hashedPassword)) {
            return true;
        } else {
            return false;
        }
    }
}
