<html>
<head>
  <title>Music Deletion Results Check</title>
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

<center><body>
<div class="form">
    <h1>Music Deletion Results Check</h1>
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
          $query = "select * from Music where ID = $id";
      }
      else {
          echo "Music Product ID: [$id] is invalid. No deletion will be made."; ?> <br /><br />
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
          echo 'No match was found.'; ?> <br /><br />
              <form method="post" action="admin_page.php">
                <p><input type="submit" name="return" value="return"></p>
                </form>
              <?php exit();
      }
    
      echo "<p>Is this the item you wish to delete?<br /></p>";
    
      for ($i=0; $i <$num_results; $i++) {
           $row = $result->fetch_assoc();
           echo "<p><strong>".($i+1).". ID: ";
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
    
     <form method="post" action="delete_music.php">
        <p>Please re-enter the ID to permanently delete: <input type="text" name="ID" value="<?php echo $id?>" readonly></p>
        <input type="submit" name="delete" value="Delete">
        <input type="hidden" name="hid" value="<?php $id?>">
      </form>
      <br /><br />
      <form method="post" action="admin_page.php">
        <p><input type="submit" name="return" value="return"></p>
      </form>
</div>
</body></center>
</html>
