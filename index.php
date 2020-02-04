<?php

// Include your database.php here
require_once('database.php');
require_once('diveShopModel.php');

// This is the controller file and identifies the action that needs to be taken
// in the web application.
// 
// Modify the switch statement below to perform the required actions.  The web
// form buttons are named 'action' and all web forms are usign the method POST
// to submit data.

// UPDATE:  assign the PHP variable $action the value from the web form button 
// that was pressed.  Remember all web form buttons are named called 'action'
$action = isset($_POST['action']) ? $_POST['action'] : null;

// UPDATE:  Use this switch statements to perform each of the web app functions.
switch ($action) {
    case 'Register Diver':
        // Replace the empty '' with the appropriate FORM POST variable.
        $first = $_POST['first'];
        $last = $_POST['last'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $email = $_POST['email'];
        // UPDATE:  Write the PHP code to call the function registerDiver from 
        // the diveShopModel. This will insert the new diver into the database
        registerDiver();

        require_once ('GetDiverID.php');
        exit;

    case 'Class Registration':
        // Replace the empty '' with the appropriate FORM POST variable.
        $email = $_POST['email'];  
        
        require_once ('RegisterDiver.php');
        exit;

    case 'Register Class':
        // Replace the empty '' with the appropriate FORM POST variables.
        $email = $_POST['email'];  
        $class = $_POST['class'];
        $days = $_POST['days'];
        $time = $_POST['time'];
        
        // UPDATE: Write the PHP code to call the function from diveShopModel 
        // to insert the new class into the diver's schedule
        registerClass();

        $msg= "<p>You are registered for " . $class . " on " . $days . ", " . $time . "<br/>";
        require_once ('RegisterDiver.php');
        exit;
    
    case 'Review Schedule':        
        // Replace the empty '' with the appropriate FORM POST variables.
        $email = $_POST['email'];  
        // UPDATE: Make the changes to call the function classSchedule from the 
        // diveShopModel file and assign the results into the $classes array
        $classes= classSchedule($email);
        require_once ('ReviewSchedule.php');
        exit;

}
require_once ('RegistrationForm.php');
?>
