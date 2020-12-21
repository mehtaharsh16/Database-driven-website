<html>
<head>
  <title>Music Search Results</title>
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

.column {
  float: left;
  width: 50%;
  padding: 10px;
}

</style>

<div class="column">
  <div class="form">
    <body>
    <h1>Music Search Results</h1>
    <?php
      
      $format = $_POST['format'];
      $name = trim($_POST['name']);
      $format_str = '';
      $email = $_POST['hid_email'];
    
      if (!get_magic_quotes_gpc()){
        if (count($format) > 0) {
            $a = [];
            foreach ($format as $f) {
                $f = "'" . addslashes($f) . "'";
                $a[] = $f;
            }
            $format_str = join(',', $a);
        }
        $name = addslashes($name);
      }
    
      @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    
      if (mysqli_connect_errno()) {
        echo 'Error: Could not connect to database.  Please try again later.'; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit;
      }
    
      if ($format_str && $name) {
        $query = "select * from Music where Name like '%".$name."%' and Format in 
            (".$format_str.")";
      }
      elseif ($format_str) {
        $query = "select * from Music where Format in (".$format_str.")";
      }
      elseif ($name) {
        $query = "select * from Music where Name like '%".$name."%'";
      }
      else {
        $query = "select * from Music";  
      }
      
      $result = $db->query($query);
      if (!$result) {
          echo "Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit;
      }
    
      $num_results = $result->num_rows;
    
      echo "<p>Number of items found: ".$num_results."</p>";
    
      for ($i=0; $i <$num_results; $i++) {
         $row = $result->fetch_assoc();
         echo "<p><strong>ID: ";
         echo htmlspecialchars(stripslashes($row['ID']));
         echo "</strong><br />Name: ";
         echo stripslashes($row['Name']);
         echo "<br />Price: $";
         echo stripslashes($row['Price']);
         echo "<br />Quantity: ";
         echo stripslashes($row['Quantity']);
         echo "<br />Format: ";
         echo stripslashes($row['Format']);
         echo "<br />Description: ";
         echo stripslashes($row['Description']);
         echo "</p>";
      }
    
      $result->free();
      $db->close(); 
      ?>
      <form method="post" action="customer_page.php">
        <p><input type="submit" name="return" value="return"></p>
        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
      </form>
    </body>
  </div>
</div>

<div class="column">
  <div class="form">  
    <h1>Add to Cart</h1>
    <form method="post" action="insert_music_cart.php">
        <p>Enter the item ID to add an item to your cart.</p>
        <p>ID: <input type="text" name="id"></p>
        <p>Quantity: <input type="text" name="quantity"></p>
        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
        <input type="submit" name="insert_music_cart" value="Add to Cart">
    </form>
  </div>
</div>
</html>
