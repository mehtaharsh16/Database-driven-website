<html>
<head>
  <title>Merch Search Results</title>
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
    <h1>Merch Search Results</h1>
    <?php
  
    $format = $_POST['format'];
    $name = trim($_POST['name']);
    $format_str = '';
    $email = $_POST['hid_email'];
    
    if (!get_magic_quotes_gpc()){
    if (count($type) > 0) {
        $a = [];
        foreach ($type as $f) {
            $f = "'" . addslashes($f) . "'";
            $a[] = $f;
        }
        $type_str = join(',', $a);
    }
    $name = addslashes($name);
    }
    
    @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    
    if (mysqli_connect_errno()) {
      echo 'Error: Could not connect to database.  Please try again later.'; ?> <br /><br />
        <form method="post" action="customer_page.php">
        <p><input type="submit" name="return" value="return"></p>
        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
        </form>
        <?php exit;
    }
    
    if ($type_str && $name) {
    $query = "select * from Merchandise where Name like '%".$name."%' and Type in (".$type_str.")";
    }
    elseif ($type_str) {
    $query = "select * from Merchandise where Type in (".$type_str.")";
    }
    elseif ($name) {
    $query = "select * from Merchandise where Name like '%".$name."%'";
    }
    else {
    $query = "select * from Merchandise";  
    }
    
    $result = $db->query($query);
    if (!$result) {
      echo "Query failed to execute"; ?> <br /><br />
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
     echo "<br />Description: ";
     echo stripslashes($row['Description']);
     echo "<br />Price: $";
     echo stripslashes($row['Price']);
     echo "<br />Type: ";
     echo stripslashes($row['Type']);
     echo "<br />Size: ";
     echo stripslashes($row['Size']);
     echo "<br />Quantity: ";
     echo stripslashes($row['Quantity']);
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
        <form method="post" action="insert_merch_cart.php">
            <p>Enter the item ID to add an item to your cart.</p>
            <p>ID: <input type="text" name="id"></p>
            <p>Quantity: <input type="text" name="quantity"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            <input type="submit" name="insert_merch_cart" value="Add to Cart">
        </form>
    </div>
</div>
</html>
