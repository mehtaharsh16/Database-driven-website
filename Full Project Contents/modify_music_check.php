<html>
<head>
  <title>Music Modification Results Check</title>
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
<h1>Music Modification Results Check</h1>
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
       echo htmlspecialchars(stripslashes($row['ID']));
       echo "</strong><br />Name: ";
       $name = $row['Name'];
       echo stripslashes($name);
       echo "<br />Price: $";
       $price = $row['Price'];
       echo stripslashes($price);
       echo "<br />Quantity: ";
       $quantity = $row['Quantity'];
       echo stripslashes($quantity);
       echo "<br />Format: ";
       $format = $row['Format'];
       echo stripslashes($format);
       echo "<br />Description: ";
       $description = $row['Description'];
       echo stripslashes($description);
       echo "</p>";
  }

  $result->free();
  $db->close();

?>

  <form method="post" action="modify_music.php"> 
    Enter Change(s):<br />
    <p>ID: <input type="text" name="id" value="<?php echo $id?>" readonly></p>
    <p>Name: <input type="text" name="name"></p>
    <p>Price: <input type="text" name="price"></p>
    
    <p>Format: <br />
    <input type="radio" id="mp3" name="format" value="mp3">
        <label for="mp3">mp3</label><br>
    <input type="radio" id="WAV" name="format" value="WAV">
        <label for="WAV">WAV</label><br>
    <input type="radio" id="CD" name="format" value="CD">
        <label for="CD">CD</label><br>
    <input type="radio" id="Vinyl" name="format" value="Vinyl">
        <label for="Vinyl">Vinyl</label><br>
    <input type="radio" id="Cassette" name="format" value="Cassette">
        <label for="Cassette">Cassette</label><br></p>
    
    <p>Quantity: <input type="text" name="quantity"></p>
    <p>Description: <textarea id="description" name="description" rows="6" cols="40"></textarea></p>
    <input type="submit" name="make changes" value="make changes">
    <input type="hidden" id="hid_name" name="hid_name" value="<?php echo $name?>">
    <input type="hidden" id="hid_format" name="hid_format" value="<?php echo $format?>">
  </form>
  
  <form method="post" action="admin_page.php">
   <p><input type="submit" name="return" value="return"></p>
  </form>

</body></div></center>
</html>
