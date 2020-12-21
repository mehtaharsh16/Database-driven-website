<html>
<head>
  <title>Music Search Results</title>
</head>
<body>
<h1>Music Search Results</h1>
<?php
  
  $format=$_POST['format'];
  $name=trim($_POST['name']);
  $format_str = '';

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
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
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
      echo "Query failed to execute";
  }

  $num_results = $result->num_rows;

  echo "<p>Number of items found: ".$num_results."</p>";

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
</body>
</html>
