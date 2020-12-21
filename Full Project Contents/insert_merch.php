<html>
<head>
  <title>Merch Product Entry Results</title>
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

<body>
<div class="form">
    <h1>Merch Product Entry Results</h1>
    <?php
      
      $name = ucwords(strtolower($_POST['name']));
      $description = $_POST['description'];
      $price = (float)$_POST['price'];
      $type = $_POST['type'];
      $quantity = (int)$_POST['quantity'];
      $size = $_POST['size'];
    
      if ($type == 'clothing' && !$size) {
          echo "Clothing insert must have a size."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      if ($type == 'item' && $size) {
          echo "Items have no size."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
    
      if (!$name || !$price || !$type || !$quantity) {
          echo "Missing name, price, type, or quantity."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
    
      @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    
      if (mysqli_connect_errno()) {
         echo "Error: Could not connect to database. Please try again later."; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
      
      $query = "select Name, Type, Description 
            from Music 
            where Name = \"$name\" and Format = \"$format\" and Description = \"$description\"";
  
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
      
      $query = "insert into Merchandise (Name, Description, Price, Type, Size, Quantity) 
                values (\"$name\", \"$description\", \"$price\", \"$type\", \"$size\", \"$quantity\")";
      $result = $db->query($query);
    
      if ($result) {
          echo  " $size Merch was properly inserted into database.";
      } else {
      	  echo "An error has occurred. The item was not added.";
      }
      ?> <br /><br />
            <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
            <?php exit();
      
      $db->close();
      
    ?>
    </div>
</body>
</html>
