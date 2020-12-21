<html>
<head>
  <title>My Cart</title>
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
      <h1>My Cart</h1>
        
      <?php  
      
        $email = $_POST['hid_email'];
        
        @ $db = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
        
        if (mysqli_connect_errno()) {
            echo 'Error: Could not connect to database.  Please try again later.'; ?>
            <form method="post" action="customer_page.php">
            <p><input type="submit" name="return" value="return"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
            <?php exit;
        }
        
        $query = "select msc_id, mch_id, quantity 
                  from Cart 
                  where Email = \"$email\"";
        
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
            if (empty($row['mch_id'])) {
                $msc_id = (int)$row['msc_id'];
                $query_msc = "select * 
                              from Music 
                              where $msc_id = id";
                $result_msc = $db->query($query_msc);
                if (!$result_msc) {
                    echo "Query failed to execute"; ?>
                    <form method="post" action="customer_page.php">
                    <p><input type="submit" name="return" value="return"></p>
                    <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                    </form>
                    <?php exit;
                }
                else {
                    $row_msc = $result_msc->fetch_assoc();
                   echo "<p><strong>Music</strong>";
                    echo "<br />ID: ";
                    echo ($row_msc['ID']);
                    echo "<br />Name: ";
                    echo ($row_msc['Name']);
                    echo "<br />Price: $";
                    echo ($row_msc['Price']);
                    echo "<br />Quantity: ";
                    echo ($row['quantity']);
                    echo "<br />Format: ";
                    echo ($row_msc['Format']);
                    echo "<br />Description: ";
                    echo ($row_msc['Description']);
                    echo "</p>";
                }
            }
            elseif (empty($row['msc_id'])) {
                $mch_id = (int)$row['mch_id'];
                $query_mch = "select * 
                              from Merchandise 
                              where $mch_id = id";
                $result_mch = $db->query($query_mch);
                if (!$result_mch) {
                    echo "Query failed to execute"; ?>
                    <form method="post" action="customer_page.php">
                    <p><input type="submit" name="return" value="return"></p>
                    <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
                    </form>
                    <?php exit;
                }
                else {
                    $row_mch = $result_mch->fetch_assoc();
                    echo "<p><strong>Merch</strong>";
                    echo "<br />ID: ";
                    echo ($row_mch['ID']);
                    echo "<br />Name: ";
                    echo ($row_mch['Name']);
                    echo "<br />Price: $";
                    echo ($row_mch['Price']);
                    echo "<br />Quantity: ";
                    echo ($row['quantity']);
                    echo "<br />Type: ";
                    echo ($row_mch['Type']);
                    echo "<br />Size: ";
                    echo ($row_mch['Size']);
                    echo "<br />Description: ";
                    echo ($row_mch['Description']);
                    echo "</p>";
                }
            }
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
      <center><form method="post" action="order_made.php">
        <h1>Order Items</h1>
        <p><input type="submit" name="make_order" value="Make order!"></p>
        <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
      </form></center>
    </div>
    
    <div class="form">
        <form method="post" action="update_cart.php"> 
            <h1>Remove Items from Cart</h1><br />
            Enter Change:<br /><br />
            <input type="radio" id="Music" name="table" value="Music">
                <label for="Music">Music</label>
            <input type="radio" id="Merchandise" name="table" value="Merchandise">
                <label for="Merchandise">Merchandise</label><br>
            <p>ID: <input type="text" name="id"></p>
            <p>Quantity: <input type="text" name="quantity"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            <p><input type="submit" name="make changes" value="make changes"></p>
        </form>
    </div>
</div>

</html>
