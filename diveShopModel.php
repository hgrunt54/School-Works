<?php

function validateForm() {
    if (empty($first) || empty($last) || empty($email)) {
        return false;
    } else {
        return true;
    }
}

function registerDiver() {
    global $db, $first, $last, $phone, $address, $city, $state, $zip, $email;
    if (!validateForm($first, $last, $email)) {
        $SQLstring = "INSERT INTO divers VALUES (NULL, '$first', '$last', '$phone', '$address', '$city', '$state', '$zip', '$email')";
        $result = $db->exec($SQLstring);
        if ($result < 1) {
            $errors = $db->errorInfo();
            $error = $errors[2];
            include('error.php');
            exit;
        }
    } else {
        die("<p>You must supply a first name, last name and email address to register! Click your browser's Back button to return to the previous page.</p>");
    }
}

function registerClass() {  // This function inserts a record into the divers class registration
    global $db, $email, $class, $days, $time;
        // UPDATE: Write the PHP commands to execute the SQL statement.  Use the function registerDiver as a template.
        $SQLstring = "INSERT INTO registration VALUES('$email', '$class', '$days', '$time')";
        $result = $db->exec($SQLstring); 
}

function classSchedule($email) {  // This function insert a record into the divers class registration page
    global $db;
    $SQLstring = "SELECT email, class, days, time FROM registration WHERE email='$email'";
    // UPDATE: Write the PHP commands to execute the SQL statement.  Return the results in a single array using the fetchall PDOStatement function.

    $results = $db->prepare($SQLstring);  // Remove null and write the command to return a PDOStatement object from your $db connection
    $results->execute();
    if ($results->rowCount() == 0) { // This if statement checks to see if they registered for any classes.  
        die("<p>You have not registered for any classes! Click your browser's Back button to return to the previous page.</p>");
    } else {
        // Remove the null and write the command to return all the rows from $result using the PDOStatement fetchall command             
        $classes = $results->fetchAll(PDO::FETCH_NUM);
        return $classes;
    }
}

?>