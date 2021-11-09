<?php
session_start(); 
$date;
if(isset($_POST["submit"])){
    //Grabbing the data from the user
    $name=$_POST["name"];
    $link=$_POST['link'];
    $date=$_POST['date'];

   
   
  

    //Instantiate SignupContr class

    include "../Meetings/MeetingControl.php";
     $signup= new meetingControl($name,$link,$date);


    //Running error handlers and user signup
    $signup->insertMeeting();

    function storedate(){
        return $date= $_POST['date'];
       };

    function storeLink(){
        return $link=$_POST['link'];
    };

    function storeName(){
        return $name=$_POST['name'];
    };
    //Moving to home page
    header("location:../MeetingView.php?error=none");
};

