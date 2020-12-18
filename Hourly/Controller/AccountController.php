<?php
include_once '../Model/Database.php';
include_once '../Model/Account.php';

class AccountController
{
    private $user;
    private $database;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Get account details to put into account object
    public function getAccount($username){
        $result = $this->database->getAccountDetails($username);
        if($result){
            foreach($result as $row){
                $account = new Account($row['user_id'], $row['password'], $row['email'], $row['birth_date']);
            }
        }
        return $account;
    }

    //Display details using account object
    public function displayAccountDetails($username){
        $account = $this->getAccount($username);
        if($account){
            echo $account->getUsername();
            echo $account->getPassword();
            echo $account->getEmail();
            echo $account->getDateOfBirth();
        }
    }

    //Update email and date of birth
    public function updateAccount($username, $email, $dateOfBirth){
        $this->database->updateAccount($username, $email, $dateOfBirth);
    }

    //Register new account
    public function createAccount($username, $password, $email, $dateOfBirth){
        $this->database->createAccount($username, $password, $email, $dateOfBirth);
    }

}