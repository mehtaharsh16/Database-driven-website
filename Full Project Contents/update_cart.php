<html>
<head>
  <title>Cart Results</title>
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
    <h1>Cart Results</h1>
    <?php
      
      $table = $_POST['table'];
      $id = (int)$_POST['id'];
      $quantity = (int)$_POST['quantity'];
      $email = $_POST['hid_email'];
      
      if ($table == 'Music') {
          $id_col = 'msc_id';
      }
      else {
          $id_col = 'mch_id';
      }
    
      if (!$id || !$table || !$quantity) {
          echo "Missing required fields"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
      if ($quantity == 0) {
          echo "Cart was not changed."; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
      if ($quantity < 0) {
          echo "Invalid quantity."; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
      @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    
      if (mysqli_connect_errno()) {
         echo "Error: Could not connect to database. Please try again later."; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
      $query = "select quantity 
                from Cart 
                where email = \"$email\" and $id_col = $id";
        
      $result = $db->query($query);
      
      if (!$result) {
          echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      $row = $result->fetch_row();
          
      if (empty($row)) {
          echo "It doesn't look like that item is in your cart."; ?>
        <form method="post" action="customer_page.php">
        <p><input type="submit" name="return" value="return"></p>
        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
        </form>
        <?php exit();
      }
      else {
          $result_val = (int)$row[0];
          $qty_diff = $result_val - $quantity;
      }
      
      if ($qty_diff < 0) {
          echo "You only have $result_val in your cart, and you requested to remove $quantity"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      elseif ($qty_diff == 0) {
          $query = "delete
                    from Cart
                    where $id_col = $id and email = \"$email\"";
          $result = $db->query($query);
          if (!$result) {
              echo "2. Query failed to execute"; ?>
                <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                </form>
                <?php exit();
          }
      }    
      else {
          $query = "update Cart
                    set quantity = $qty_diff
                    where $id_col = $id and email = \"$email\"";
          $result = $db->query($query);
          if (!$result) {
              echo "3. Query failed to execute"; ?>
                <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                </form>
                <?php exit();
          }
      }
      
      $query = "select Quantity
                from $table
                where ID = $id";

      $result = $db->query($query);
      if (!$result) {
          echo "4. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
          
      $row = $result->fetch_row();
      $result = (int)$row[0];
      $qty_sum = $result + $quantity;
      
      $query = "update $table
                set Quantity = $qty_sum
                where ID = $id";
      
      $result = $db->query($query);
  
      if (!$result) {
          echo "5. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
      echo "Item quantity successfully modified."; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php
      
      $db->close();
    ?>
    </body>
  </div>
</div>
</html>