<html>
<head>
  <title>Update My Profile</title>
</head>

<style>
* {
  box-sizing: border-box;
}

.form {
  background-color: white;
  width: 500px;
  border: 5px solid black;
  padding: 50px;
  margin: 30px;
  text-align: left;
}
</style>

<center><div class="form">
<body>
<h1>Update My Profile</h1>

<?php
  $email = $_POST['email'];
  $pwd = sha1($_POST['password']);
 
  if ((!isset($email)) || (!isset($pwd))) {
      echo "Email and/or password are missing."; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  @   $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');

  if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.'; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  $query = "select * from User where Email = \"$email\" and Pwd = \"$pwd\"";
  
  $result = $db->query($query);
  if (!$result) {
      echo "No match found."; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  $num_results = $result->num_rows;

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". Name: ";
     $fname = $row['Fname'];
     echo htmlspecialchars(stripslashes($fname));
     $lname = $row['Lname'];
     echo " $lname</strong>";
     echo "<br />Email: ";
     $email = $row['Email'];
     echo stripslashes($email);
     echo "<br />Address: ";
     $address = $row['Address'];
     echo stripslashes($address);
     echo "<br />Phone #: ";
     $phone = $row['Phone'];
     echo stripslashes($phone);
     echo "</p>";
  }

  $result->free();
  $db->close();

?>

 <form method="post" action="modify_customer_profile.php"> 
    Enter Change(s):<br />
    <p>First Name: <input type="text" name="fname"></p>
    <p>Last Name: <input type="text" name="lname"></p>
    <p>Email: <input type="text" name="email" ></p>
    <p>Address: <input type="text" name="address" ></p>
    <p>Phone #: <input type="text" name="phone" ></p>
    <p>Password: <input type="password" name="password" ></p>
    <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
    <p><input type="submit" name="make changes" value="make changes"></p>
  </form>
 
<form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
</body></div></center>
</html>
