<html>
<head>
  <title>Profile Update Results</title>
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
<h1>Profile Update Results</h1>
<?php
  
  $email = $_POST['email'];
  $fname = ucwords(strtolower($_POST['fname']));
  $lname = ucwords(strtolower($_POST['lname']));
  $phone = $_POST['phone'];
  $address = ucwords(strtolower($_POST['address']));
  $password = $_POST['password'];
  
  $hid_email = $_POST['hid_email'];

  @   $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');

  if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.'; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }

  if ($email) {
      $query = "select Email from User where Email = \"$email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "Email modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $num_results = $result->num_rows;
      
      if ($num_results != 0) {
          echo 'Email is already being used.'; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          $query = "update User set Email = \"$email\" where Email = \"$hid_email\"";
          $result = $db->query($query);
      
          if (!$result) {
              echo "Email modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
          }
          else {
              echo "<p>Email successfully modified<br /></p>";
          }
      }
      
  }
  
  if ($fname) {
      $query = "update User 
                set Fname = \"$fname\"
                where Email = \"$hid_email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "First Name modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
              echo "<p>First Name successfully modified<br /></p>";
          }
  }
  
  if ($lname) {
      $query = "update User 
                set Lname = \"$lname\"
                where Email = \"$hid_email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "Last Name modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
              echo "<p>Last Name successfully modified<br /></p>";
          }
  }
  
  if ($address) {
      $query = "update User 
                set Address = \"$address\"
                where Email = \"$hid_email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "Address modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
              echo "<p>Address successfully modified<br /></p>";
          }
  }
  
  if ($phone) {
      $query = "update User 
                set Phone = \"$phone\"
                where Email = \"$hid_email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "Phone # modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
              echo "<p>Phone # successfully modified<br /></p>";
          }
  }
  
  if ($password) {
      $password = sha1($password);
      $query = "update User 
                set Pwd = \"$password\"
                where Email = \"$hid_email\"";
      $result = $db->query($query);
      
      if (!$result) {
          echo "Password modification failed to execute"; ?> <br /><br />
              <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
              echo "<p>Password successfully modified<br /></p>";
          }
  }
  
  $db->close()

?>

<form method="post" action="customer_page.php">
<p><input type="submit" name="return" value="return"></p>
</form>
</body></div></center>
</html>
