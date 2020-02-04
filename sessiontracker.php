<?php
// Before anything else happens start the session
// Step 1: begin session
$lifetime = 60*60*24*365;
session_set_cookie_params($lifetime, '/');
session_start();

function logoutform() {
// Step 2: clear the SESSION array and destroy the session
    session_destroy();
}

require_once('/var/www/cweb146/cookieheader.php');
require_once('/var/www/cweb146/sidebar.php');
?>

<div id="content">
<h1>Session Tracker</h1>
<p>
<?php
// Step 2: There are two possible values for the submit button called 'action' and they are "Login" and "Logout".
// First see if the array $_POST has a value for 'action' using the empty function. Replace FALSE with this test
if (!empty($_POST['action'])) {
// $_POST['action'] is not empty
// Step 3: Which action are we performing Login or Logout replace FALSE with an appropriate test
if ($_POST['action'] = 'Login') { 
// Logging in
// Step 4: Update the call to the validlogin function with the appropriate $_POST parameters
$login = validlogin($_POST['username'], $_POST['password']);
// Step 5: replace FALSE with the correct PHP variable that has the result of the attempted login
if ($login = true) {
// login was successful
// Step 6: create the SESSION variable 'is_authenticated' and set it to TRUE before we include webapp.php
$_SESSION['is_authenticated'] = true;
$is_authenticate = $_SESSION['is_authenticated'];
require_once('/var/www/cweb146/webapp.php');
} else {
// login failed lets send them back to the main page.
$url = 'sessiontracker.php';
header("Location: " . $url);
exit();
}
} else {
// Logging out
// Step 7: call the logoutform function
        logoutform();
$url = 'sessiontracker.php';
header("Location: " . $url);
exit();
}
} else {
// $_POST['action'] is empty
// Step 8: Since no button was pressed either we are visiting the page for the first time or we are returning to this web page
// as part of an authenticated session. Replace FALSE with a check of the 'is_authenticated' SESSION variable to see if it is TRUE
if ($is_authenticated = true) { 
// The 'is_authenticated' $_SESSION variable is TRUE so include the webapp.php
require_once('/var/www/cweb146/webapp.php');
} else {
// The 'is_authenticated' $_SESSION variable is FALSE so print the loginform
loginform();
}
}
?>
</p>
</div>

<?php

function loginform() {
print ('
<form action="sessiontracker.php" method="post" > 
<table width="400px"> 
<tr><td><label>Username: </label></td><td><input type="text" name="username" /></td></tr>
<tr><td><label>Password: </label></td><td><input type="text" name="password" /></td></tr>
<tr><td colspan="2">
*Use username of admin and password sesame</td></tr>
<tr><td colspan="2">
<input type="submit" name="action" value="Login"/>
</td></tr>
</table>
</form>
');
}

function validlogin($email, $password) {
    // we could query a DB to validate logins but this is a simple example
    if (($email=='admin') && ($password=='sesame')) {
      return TRUE;
    } else {
      return FALSE;
    }
}

require_once('/var/www/cweb146/footer.php');
?>