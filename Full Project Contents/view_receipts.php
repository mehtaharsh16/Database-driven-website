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
    <center><h1>PAST ORDERS</h1></center>
    
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
      
        $query = "select ID, DATE(dt) as d, TIME(dt) as t, total, item 
                  from Receipt 
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
    
        echo "<p>Orders made: ".$num_results."</p>";
        
        for ($i=0; $i <$num_results; $i++) {
         $row = $result->fetch_assoc();
         echo "<p><strong>ID: ";
         echo ($row['ID']);
         echo "</strong><br />Date: ";
         echo ($row['d']);
         echo "</strong><br />Time: ";
         echo ($row['t']);
         echo "<br />Total $: ";
         echo ($row['total']);
         echo "<br />Items: ";
         echo ($row['item']);
         echo "</p>";
        }
        
    ?>
  </body>
</div></center>

<center><form method="post" action="customer_page.php">
    <p><input type="submit" name="return" value="return"></p>
    <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
</form></center>
</html>