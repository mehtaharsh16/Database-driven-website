<html>
<head>
  <title>Merchandise Modification Results Check</title>
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
<h1>Merchandise Modification Results Check</h1>
<?php
  
  $id = (int)$_POST['ID'];

  @   $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');

  if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
  if ($id > 0) {
      $query = "select * from Merchandise where ID = $id";
  }
  else {
      echo "Merchandise Product ID: [$id] is invalid. No modification will be made."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }
  
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
      echo 'Item not found.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
  }

  echo "<p>Is this the item you wish to modify?<br /></p>";

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". ID: ";
     $id = $row['ID'];
     echo htmlspecialchars(stripslashes($id));
     echo "</strong><br />Name: ";
     $name = $row['Name'];
     echo stripslashes($name);
     echo "<br />Description: ";
     $description = $row['Description'];
     echo stripslashes($description);
     echo "<br />Price: $";
     $price = $row['Price'];
     echo stripslashes($price);
     echo "<br />Type: ";
     $type = $row['Type'];
     echo stripslashes($type);
     echo "<br />Size: ";
     $size = $row['Size'];
     echo stripslashes($size);
     echo "<br />Quantity: ";
     $quantity = $row['Quantity'];
     echo stripslashes($quantity);
     echo "</p>";
  }

  $result->free();
  $db->close();

?>

 <form method="post" action="modify_merch.php"> 
    Enter Change(s):<br />
    <p>ID: <input type="text" name="id" value="<?php echo $id?>" readonly></p>
    <p>Name: <input type="text" name="name"></p>
    <p>Price: <input type="text" name="price"></p>
    <p>Type: </p>
        <input type="radio" id="clothing" name="type" value="clothing">
            <label for="clothing">clothing</label><br>
        <input type="radio" id="item" name="type" value="item">
            <label for="item">item</label><br>
    <p>Size (for clothing only): </p>
        <input type="radio" id="small" name="size" value="small">
            <label for="small">small</label><br>
        <input type="radio" id="medium" name="size" value="medium">
            <label for="medium">medium</label><br>
        <input type="radio" id="large" name="size" value="large">
            <label for="large">large</label><br>
    <p>Quantity: <input type="text" name="quantity"></p>
    <p>Description: <textarea id="description" name="description" rows="6" cols="40"></textarea></p>
    <p><input type="submit" name="make changes" value="make changes"></p>
  </form>
 
  <form method="post" action="admin_page.php">
 <p><input type="submit" name="return" value="return"></p>
  </form>
</body></div></center>
</html>
