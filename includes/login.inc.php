<?php
/**
 *this class get the input from the user frontend
 *Also calls all the other classes
 *Redirects to home page when suggesuflly signed up
 */


if(isset($_POST["submit1"])){
    //Grabbing the data from the user
    
    $email=$_POST['email'];

    $password=$_POST['password'];
   
    echo $firstname;

    //Instantiate SignupContr class

    include "../classes/loginControl.classes.php";
     $login= new LoginContr($email,$password);


    //Running error handlers and user signup
     $login->validateInput();

    //Moving to home page
    header("location:../index.php?error=none");
};