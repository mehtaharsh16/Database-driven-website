<html>
<head>
  <title>Music Product Modification Results</title>
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
<h1>Music Product Modification Results</h1>
<?php
  
  $id = (int)$_POST['id'];
  $name=ucwords(strtolower($_POST['name']));
  $price = (float)$_POST['price'];
  $quantity = (int)$_POST['quantity'];
  $format = $_POST['format'];
  $description = $_POST['description'];
  
  $hid_name = ucwords(strtolower($_POST['hid_name']));
  $hid_format = $_POST['hid_format'];

  if (!get_magic_quotes_gpc()) {
      $id = addslashes($id);
  }

  @   $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');

  if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }

  $query = "select ID from Music where ID = $id";
  
  $result = $db->query($query);
  if (!$result) {
      echo "Query failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  $num_results = $result->num_rows;
  
  if ($num_results == 0) {
      echo 'No match was found.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  if ($name && !$format) {
      $query = "select Name, Format from Music where Name = \"$name\" and Format = \"$hid_format\"";
  
      $result = $db->query($query);
      
      if (!$result) {
          echo "Query failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $num_results = $result->num_rows;
      
      if ($num_results > 0) {
          echo 'Item already exists.'; ?>
          <a href="admin_page.php">Return</a>
          <?php exit;
      }
      
      $query = "update Music set Name = \"$name\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Name modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Name successfully modified<br /></p>";
      }
  }
  
  if (!$name && $format) {
      $query = "select Name, Format from Music where Name = \"$hid_name\" and Format = \"$format\"";
  
      $result = $db->query($query);
      
      if (!$result) {
          echo "Query failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $num_results = $result->num_rows;
      
      if ($num_results > 0) {
          echo 'Item already exists.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $query = "update Music set Format = \"$format\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Name modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Format successfully modified<br /></p>";
      }
  }
  
  if ($name && $format) {
      $query = "select Name, Format from Music where Name = \"$name\" and Format = \"$format\"";
  
      $result = $db->query($query);
      
      if (!$result) {
          echo "Query failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $num_results = $result->num_rows;
      
      if ($num_results > 0) {
          echo 'Item already exists.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $query = "update Music set Name = \"$name\", Format = \"$format\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Name modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Format and Name successfully modified<br /></p>";
      }
  }
  
  if ($price) {
      $query = "update Music set Price = \"$price\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Price modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Price successfully modified<br /></p>";
      }
  }
  
  if ($quantity) {
      $query = "update Music set Quantity = \"$quantity\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Quantity modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Quantity successfully modified<br /></p>";
      }
  }
  
  if ($description) {
      $query = "update Music set Description = \"$description\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Description modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Description successfully modified<br /></p>";
      }
  }
  
  $db->close();

?>

 <form method="post" action="admin_page.php">
  <p><input type="submit" name="return" value="return"></p>
 </form>
</body></div></center>
</html>
