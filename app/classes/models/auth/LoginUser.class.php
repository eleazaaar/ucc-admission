<?php

class LoginUser extends Database {
  
    // Check weather if user already exists
    protected function checkUser($email)
    {
        $pdo = $this::connection();   
        $sql = "SELECT id FROM admission_user WHERE email=:email;";
        $stmt = $pdo->prepare($sql);        
        $stmt->execute([':email'=>$email]);

        $result = $stmt->fetchAll();
        
        return (count($result) > 0);
    }

    protected function loginUser($email, $password)
    {
        $pdo = $this::connection();   
        $sql = "SELECT * FROM admission_user WHERE email=:email;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email'=>$email]);             
        
        if  ($row = $stmt->fetchAll()){
            $pwdCheck = password_verify($password, $row[0]['password']);      
            if(!$pwdCheck){
                Page::route('/login.php?error=incorrectpassword&email='.$email);
            }else{    
                $_SESSION['admission_user_token'] = $row[0]['id'];
                $_SESSION['user_name'] = $row[0]['name'];
                $_SESSION['user_email'] = $row[0]['email'];
                $_SESSION['user_type'] = $row[0]['user_type'];
                $_SESSION['user_campus'] = $row[0]['user_campus'];
                // Page::route('/index.php');
            }
        }                          
        else {
            Page::route('/login.php?error=wrongcredentials');
        }        
    }
}