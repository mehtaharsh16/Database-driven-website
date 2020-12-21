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
</style>

<center><div class="form">
  <body>
    <center><h1>RECEIPT</h1></center>
    
    <?php  
      
        $email = $_POST['hid_email'];
        
        @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    
        if (mysqli_connect_errno()) {
            echo "Error: Could not connect to database. Please try again later."; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
      }
      
        $query = "select * 
                  from Cart 
                  where email = \"$email\"";
      
        $result = $db->query($query);
        
        if (!$result) {
          echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        $num_results = $result->num_rows;
    
        if ($num_results == 0) {
          echo "No items were in the cart"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        echo "<p>Number of items ordered: ".$num_results."</p>";
        
        $msc_qty = [];
        $mch_qty = [];
        
        for ($i=0; $i <$num_results; $i++) {
            $row = $result->fetch_assoc();
            $msc = $row['msc_id'];
            $mch = $row['mch_id'];
            $qty = (int)$row['quantity'];
            
            if (!empty($msc)) {
                $msc_id[] = $msc;
                $msc_qty[$msc] = $qty;
            }
            if (!empty($mch)) {
                $mch_id[] = $mch;
                $mch_qty[$mch] = $qty;
            }
        }
        
        $msc_id_str = join(",", $msc_id);
        $mch_id_str = join(",", $mch_id);
        
        if (!empty($msc_id)) {
            $query = "select Price, Name, Format, ID
                      from Music
                      where ID in ($msc_id_str)";
        }
      
        $result_msc = $db->query($query);
        
        if (!$result_msc) {
            echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        if (!empty($mch_id)) {
            $query = "select Price, Name, ID
                      from Merchandise
                      where ID in ($mch_id_str)";
        }
      
        $result_mch = $db->query($query);
        
        if (!$result_mch) {
            echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        $total = 0.0;
        $items = [];
        
        $num_results_msc = $result_msc->num_rows;
        
        for ($i=0; $i <$num_results_msc; $i++) {
            $row = $result_msc->fetch_assoc();
            $msc_id = (int)$row['ID'];
            $msc_price = (float)$row['Price'];
            $quantity = $msc_qty[$msc_id];
            $total += ($msc_price * $quantity);
            $msc_name = $row['Name'];
            $msc_format = $row['Format'];
            $items[] = "$msc_name [$msc_format] ($quantity)";
        }
        
        $num_results_mch = $result_mch->num_rows;
        
        for ($i=0; $i <$num_results_mch; $i++) {
            $row = $result_mch->fetch_assoc();
            $mch_id = (int)$row['ID'];
            $mch_price = (float)$row['Price'];
            $quantity = $mch_qty[$mch_id];
            $total += ($mch_price * $quantity);
            $mch_name = $row['Name'];
            $items[] = "$mch_name ($quantity)";
        }
        
        $items_str = join(", ", $items);
        echo "total: <strong>$$total </strong><br /><br />items: $items_str";
        
        $query = "insert into Receipt (total, email, item)
                  values ($total, \"$email\", \"$items_str\")";
        
        $result = $db->query($query);
        if (!$result) {
            echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        $query = "delete
                  from Cart
                  where email = \"$email\"";
        
        $result = $db->query($query);
        if (!$result) {
            echo "1. Query failed to execute"; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit();
        }
        
        $db->close();
    
    ?>
  </body>
</div></center>

<center><form method="post" action="customer_page.php">
    <p><input type="submit" name="return" value="return"></p>
    <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
</form></center>
</html>