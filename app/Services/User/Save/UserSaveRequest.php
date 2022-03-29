<?php

namespace App\Services\User\Save;

class UserSaveRequest {

    private string $name;
    private string $surname;

    public function __construct(string $name, string $surname)
    {

        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}