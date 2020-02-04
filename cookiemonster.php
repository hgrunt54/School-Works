<?php
// cookiemonster.php
// Before anything else happens set cookies if they have clicked the “submit” button
// Step 1: write the code using an if statement and empty function to test if the form was submitted

if (isset($_POST['submit'])) {
// Assign values to cookies called "name", “address”, “contact” from the from the web form data 
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $address = isset($_POST['address']) ? $_POST['address'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $expire = strtotime('+1 year');
    setcookie('name', $name, $expire, '/');
    setcookie('address', $address, $expire, '/');
    setcookie('contact', $contact, $expire, '/');
}

if (!empty($_COOKIE)) {
    $name = $_COOKIE['name'];
    $address = $_COOKIE['address'];
    $contact = $_COOKIE['contact'];
}

// Step 2: write the code to call the deleteCookie function if the button was pressed
if (isset($_POST['delete']))
{
    $name = '';
    $address = '';
    $contact = '';
    deleteCookie();
}
// Step 3: write the code to retrieve the cookie values if they are not empty
// assign the cookies to the variables $name, $address and $contact

function deleteCookie() {
// Step 4:write the code to delete the cookies “name”, “address” and “contact”
    $expire = strtotime('-1 year');
    setcookie('name', '', $expire, '/');
    setcookie('address', '', $expire, '/');
    setcookie('contact', '', $expire, '/');
}
?>
<?php include '/var/www/cweb146/cookieheader.php'; ?>
<?php include '/var/www/cweb146/sidebar.php'; ?>
<div id="content">
<h1>Cookie Monster</h1>
<p>
<form action="cookiemonster.php" method="post" >
<table width="400px">
<tr><td><label><strong>Name:</strong> </label></td><td><input type="text" name="name" /></td></tr>
<tr><td><label><strong>Address:</strong> </label></td><td><input type="text" name="address" /></td></tr>
<tr><td><label><strong>Contact:</strong> </label></td><td>
<select name="contact" />
<option value="Email"/>Email
<option value="Phone"/>Phone
<option value="Mail"/>Mail
</select></td></tr>
<tr><td colspan="2">
<input type="submit" name="submit" value="Set Cookies"/>
</td></tr>
<tr><td colspan="2">
<input type="submit" name="delete" value="Delete Cookies"/>
</td></tr>
</table>
</form>
</p>
</div>
<div>
<p>
<h3>Results:</h3>
<?php
  echo "Name: " . $name . "</br>";
  echo "Address: " . $address . "</br>";
  echo "Contact: " . $contact . "</br>";
?>
</p>
</div>

<?php
  include '/var/www/cweb146/footer.php';
?>