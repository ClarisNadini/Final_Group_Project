<?php
// It instantiate the variables taken form the forntend and run some controls on them
/**
 * First extend the signup classs
 * 
 * instantiate it 
 * 
 * create the variable we would accept form in to the database from the  frontend
 * 
 * run controls on the inputs
 */

 include "login.classes.php";

 class LoginContr extends Login{

    private $email;
    private $password;
    

    function __construct($email,$password,)
    {
        
        $this->password=$password;
        $this->email= $email;
        
    }

    //control for input
  public  function emptyinput(){
        $result= '';
        if (empty($this->email)||empty($this->password)){
            return $result=false;
        }
        else{
            return $result=true;
        }
        return $result;
        }
 

    //validate email
    function invalidemail(){
        $result='';
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return $result=false;
        }
        else{
            return $result=true;
        }
        return $result;
    }

  

    function Usercheck(){
        $result='';
        $userObj= new Login();
        if(!$userObj->getUser($this->email,$this->password)){
             return $result= false;
        }
        else{
            return $result= true;
        }
        return $result;
    }
//Checks all the validation done
   public function validateInput(){
        if ($this->emptyinput()==false){
            header('location: ../index.php?error=emptyinput');
            exit();
             }
            }  
}




