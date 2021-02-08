<?php


class Account
{
    protected $username;
    protected $password;
    protected $email;
    protected $dateOfBirth;

    public function __construct($username, $password, $email, $dateOfBirth)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->dateOfBirth = $dateOfBirth;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }



}