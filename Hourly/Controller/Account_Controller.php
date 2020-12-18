<?php
include_once '../Model/Database.php';
include_once '../Model/Account.php';

class Account_Controller
{
    private $user;
    private $database;

    public function __construct($user)
    {
        $this->user = $user;
        $this->database = new Database();
    }

    //Get account details to put into account object
    public function getAccount(){
        $result = $this->database->getAccountDetails($this->user);
        if($result){
            foreach($result as $row){
                $account = new Account($row['user_id'], $row['password'], $row['email'], $row['birth_date']);
            }
        }
        return $account;
    }

    //Display details using account object
    public function displayAccountDetails(){
        $account = $this->getAccount();
        if($account){
            echo '<form method="post" action="../Controller/accountController.php">';
            echo '<label for="email">Email Address: </label><input class="form-control col-sm-8" id="email" name="email" type="email" value="'.$account->getEmail().'">';
            echo '<label for=birthdate>Date Of Birth: </label><input <input class="form-control col-sm-8" id="birthdate" name="birthdate" type="date" value="'.$account->getDateOfBirth().'">';
            echo '<button type="submit" class="btn btn-primary" id="editAccountBtn" name="editAccountBtn">Save Edit</button>';
            echo '</form>';
        }
    }

    //Update email and date of birth
    public function updateAccount($email, $dateOfBirth){
        $this->database->updateAccount($this->user, $email, $dateOfBirth);
    }

    //Register new account
    public function createAccount($username, $password, $email, $dateOfBirth){
        $this->database->createAccount($username, $password, $email, $dateOfBirth);
    }

}