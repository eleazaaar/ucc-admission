<?php
class LoginUserController extends LoginUser{

    private $email;
    private $password;

    public function __construct($email, $password){
        $this->email = $email;
        $this->password = $password;
    }

    public function login()
    {
        // Validations    
        if($this->empytInput()){
            Page::route('/login.php?error=emptyinput');
        }
        // if($this->invalidEmail()){
        //     Page::route('/login.php?error=emptyinput');
        // }
        // if($this->emailTakenCheck()){
        //     Page::route('/login.php?error=emailnotexist');
        // }

        $this->loginUser($this->email, $this->password);
    }

    private function empytInput(){
        return (empty($this->email) || empty($this->password));
    }

    // private function invalidEmail(){
    //     return !filter_var($this->email, FILTER_VALIDATE_EMAIL);
    // }

    private function emailTakenCheck(){        
        return $this->checkUser($this->email);
    }
}