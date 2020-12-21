<html>
<head>
  <title>Music Product Entry Results</title>
</head>
<body>
<h1>Music Product Entry Results</h1>
<?php
  
  $name=ucwords(strtolower($_POST['name']));
  $description=$_POST['description'];
  $price=$_POST['price'];
  $format=$_POST['format'];
  $quantity=$_POST['quantity'];

  $bad=0;

  if (!$name) {
      echo "Missing name";
      $bad=1;
      
  }
  if (!$format) {
      echo "Missing format";
      $bad=1;
  }
  if (!$price) {
      echo "Missing price";
      $bad=1;
  }
  if (!$quantity) {
      echo "Missing quantity";
      $bad=1;
  }
  if ($bad>0) {
      exit(1);
  }

  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $description = addslashes($description);
    $format = addslashes($format);
    $price = addslashes($price);
    $quantity = doubleval($quantity);
  }

  @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database. Please try again later."; ?>
      <form method="post" action="admin_page.php">
      <p><input type="submit" name="return" value="return"></p>
      </form> 
      <?php exit();
  }

  $query = "select Name, Format 
            from Music 
            where Name = \"$name\" and Format = \"$format\"";
  
  $result = $db->query($query);
  
  if (!$result) {
      echo "Query failed to execute"; ?>
      <form method="post" action="admin_page.php">
      <p><input type="submit" name="return" value="return"></p>
      </form> 
      <?php exit();
  }
  
  $num_results = $result->num_rows;
  
  if ($num_results > 0) {
      echo 'Item already exists.'; ?>
      <form method="post" action="admin_page.php">
      <p><input type="submit" name="return" value="return"></p>
      </form> 
      <?php exit();
  }
  
  $query = "INSERT INTO Music (Name, Format, Price, Quantity, Description) 
            VALUES (\"$name\", \"$format\", \"$price\", \"$quantity\", \"$description\")";
  $result = $db->query($query);

  if ($result) {
      echo  $db->affected_rows." music items were properly inserted into database.";
  } else {
  	  echo "An error has occurred. The item was not added.";
  }
    ?>
      <form method="post" action="admin_page.php">
      <p><input type="submit" name="return" value="return"></p>
      </form> 
      <?php exit();
  $db->close();
  
?>
</body>
</html>
