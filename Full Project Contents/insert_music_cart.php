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
      
      $id = (int)$_POST['id'];
      $quantity = (int)$_POST['quantity'];
      $email = $_POST['hid_email'];
    
      if (!$id) {
          echo "Missing ID"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
          
      }
      if (!$quantity) {
          echo "Missing quantity"; ?>
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
      
      $query = "select Quantity 
                from Music 
                where ID = $id";
    
      $result = $db->query($query);
      
      if (!$result) {
          echo "Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit;
      }
      else {
          $row = $result->fetch_row();
          $result_val = (int)$row[0];
          $qty_diff = $result_val - $quantity;
      }
      
      if ($qty_diff < 0) {
          echo "There are only $result_val in stock, and you requested $quantity"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      else {
          $query = "select quantity 
                    from Cart 
                    where msc_id = $id";
          
          $result = $db->query($query);
      
          if (!$result) {
              echo "Query failed to execute"; ?>
                <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                </form>
                <?php exit();
          }
          else {
              $row = $result->fetch_row();
              if (empty($row)) {
                  $query = "insert into Cart (msc_id, mch_id, quantity, email) 
                            values ($id, NULL, $quantity, \"$email\")";
    
                  $result = $db->query($query);
                  
                  if (!$result) {
                      echo "Cart failed to insert item(s)"; ?>
                        <form method="post" action="customer_page.php">
                        <p><input type="submit" name="return" value="return"></p>
                        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                        </form>
                        <?php exit();
                  }
                  else {
                      echo "Item successfully added to cart."; ?>
                        <form method="post" action="customer_page.php">
                        <p><input type="submit" name="return" value="return"></p>
                        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                        </form>
                        <?php 
                  }
              }
              else {
                  $result_val = (int)$row[0];
                  $qty_sum = $result_val + $quantity;
                  $query = "update Cart 
                            set quantity = $qty_sum
                            where msc_id = $id";
                    
                  $result = $db->query($query);
                  
                  if (!$result) {
                      echo "Cart failed to insert item(s)"; ?>
                        <form method="post" action="customer_page.php">
                        <p><input type="submit" name="return" value="return"></p>
                        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                        </form>
                        <?php exit();
                  }
                  else {
                      echo "Item successfully added to cart."; ?>
                        <form method="post" action="customer_page.php">
                        <p><input type="submit" name="return" value="return"></p>
                        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                        </form>
                        <?php
                  }
              }
          }  
      }
      
      $query = "update Music 
                set Quantity = $qty_diff 
                where ID = $id";
    
      $result = $db->query($query);
          
          if (!$result) {
              echo "Music Product Quantity could not update."; ?>
                <form method="post" action="customer_page.php">
                <p><input type="submit" name="return" value="return"></p>
                <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                </form>
                <?php exit();
          }
      
      $db->close();
    ?>
    </body>
  </div>
</div>
</html>