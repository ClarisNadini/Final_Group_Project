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

 include "signup.classes.php";

 class SignUpContr extends SignUp{
    private $firstname;
    private $lastname;
    private $school;
    private $email;
    private $password;
    private $passwordcon;

    function __construct($firstname,$lastname,$school,$email,$password,$passwordcon)
    {
        $this->firstname= $firstname;
        $this->lastname= $lastname;
        $this->school= $school;
        $this->password=$password;
        $this->passwordcon=$passwordcon;
        $this->email= $email;
        
    }

    //control for input
  public  function emptyinput(){
        $result= '';
        if (empty($this->firstname)||empty($this->lastname)||empty($this->school)||empty($this->email)||empty($this->password)||empty($this->passwordcon)){
            return $result=false;
        }
        else{
            return $result=true;
        }
        return $result;
        }
    //control password
    function invalidpassword(){
        $result= '';
        $uppercase= preg_match('@[A-Z]@',$this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) {
            return $result=false;
        }else{
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

    function comparePassword(){
        $result='';
        if($this->password!==$this->passwordcon){
            return $result=false;
        }
        else{
            return $result=true;
        }
        return $result;
    }

    function Usercheck(){
        $result='';
        $userObj= new SignUp();
        if(!$userObj->checkUser($this->email)){
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

        if ($this->invalidpassword()==false){
            header('location: ../index.php?error=invalidpassword');
        }
        if ($this->comparePassword()==false){
            header('location: ../index.php?error=checkpassword');
            exit();
        }

        if($this->invalidemail()==false){
            header('location: ../index.php?error=invalidemail');
            exit();
        }

        if($this->UserCheck()==false){
            header('location: ../index.php?error=userexist');
        }
        $inputUser= new SignUp();
        $inputUser->setUser($this->firstname,$this->lastname,$this->school,$this->email,$this->password);   
}
}






