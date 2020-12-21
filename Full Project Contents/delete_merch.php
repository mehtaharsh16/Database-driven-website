<html>
<head>
  <title>Merchandise Product Deletion Results</title>
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
<h1>Merchandise Product Deletion Results</h1>
<?php
  
  $id = $_POST['ID'];
  $hid = $POST['hid'];

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

  $query = "select ID from Merchandise where ID = $id";
  
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
  
  if ($id) {
      $query = "delete from Merchandise where ID = $id";
  }
  else {
      echo 'Music Product ID was not entered. No deletion will be made.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  $result = $db->query($query);
  if (!$result) {
      echo "Deletion failed to execute";
  }

  echo "<p>Item successfully deleted<br /></p>";
  
  $db->close(); ?> 
  <br /><br />
  <form method="post" action="admin_page.php">
  <p><input type="submit" name="return" value="return"></p>
  </form>
  <?php exit();

?>

</body></div></center>
</html>
