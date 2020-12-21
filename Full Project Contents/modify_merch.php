<html>
<head>
  <title>Merchandise Product Modification Results</title>
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
<h1>Merchandise Product Modification Results</h1>
<?php
  
  $id = (int)$_POST['id'];
  $name=ucwords(strtolower($_POST['name']));
  $price = (float)$_POST['price'];
  $quantity = (int)$_POST['quantity'];
  $type = $_POST['type'];
  $description = $_POST['description'];
  $size = $_POST['size'];

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
  
  if ($name) {
      $query = "update Merchandise set Name = \"$name\" where ID = $id";
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
  
  if ($price) {
      $query = "update Merchandise set Price = \"$price\" where ID = $id";
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
      $query = "update Merchandise set Quantity = \"$quantity\" where ID = $id";
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
      $query = "update Merchandise set Description = \"$description\" where ID = $id";
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
  
  if ($type == 'item' && $size) {
      echo "Items have no size"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  if ($type == 'item' && !$size) {
      $query = "update Merchandise set Type = \"$type\", Size = null where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Type modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Type successfully modified (Size set to null).<br /></p>";
      }
  }
  
  if ($type == 'clothing' && $size) {
      $query = "update Merchandise set Type = \"$type\", Size = \"$size\" where ID = $id";
      $result = $db->query($query);
      if (!$result) {
          echo "Type modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      else {
          echo "<p>Type successfully modified<br /></p>";
      }
  }
  
  if ($type == 'clothing' && !$size) {
      echo "Clothing requires a size."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
  
  if ($size && !$type) {
      $query = "select Type from Merchandise where ID = $id";
      $result = $db->query($query);
      $row = $result -> fetch_assoc();
          
      if (!$result) {
          echo "Size modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      if ($row['Type'] == 'item') {
          echo "Type = Item. Cannot include size.";
      }
      else {
          $query = "update Merchandise set Size = \"$size\" where ID = $id";
          $result = $db->query($query);
          if (!$result) {
              echo "Size modification failed to execute"; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
          }
          else {
                  echo "<p>Size successfully modified<br /></p>";
              }
      }
  }
  $db->close()

?>

<form method="post" action="admin_page.php">
<p><input type="submit" name="return" value="return"></p>
</form>
</body></div></center>
</html>
