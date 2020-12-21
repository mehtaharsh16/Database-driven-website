<html>
<head>
  <title>Merch Search Results</title>
</head>
<body>
<h1>Merch Search Results</h1>
<?php
  
  $type = $_POST['type'];
  $name = ucwords(strtolower($_POST['name']));
  $type_str = '';
  
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
          <a href="admin_page.php">Return</a>
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
          <a href="admin_page.php">Return</a>
          <?php exit;
  }

  $num_results = $result->num_rows;

  echo "<p>Number of items found: ".$num_results."</p>";

  for ($i=0; $i <$num_results; $i++) {
     $row = $result->fetch_assoc();
     echo "<p><strong>".($i+1).". ID: ";
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

?>  <br /><br />
    <a href="admin_page.php">Return</a>
  </body>
</html>
