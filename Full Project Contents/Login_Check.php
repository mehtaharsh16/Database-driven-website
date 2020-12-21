<?php
    $email = $_POST['email'];
    $password = $_POST['password'];
  
    if (!$email || !$password) {
    echo "Missing email and/or password."; ?>
        <form method="post" action="Login_Page.php">
        <p><input type="submit" name="return" value="return"></p>
        </form>
        <?php exit();
    } 
  
    @ $mysql = new mysqli('localhost:3306', 'sternm2', 'Breakbot123', 'sternm2_FAIR VISIONS');
    if ($mysql -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error; ?>
            <form method="post" action="Login_Page.php">
            <p><input type="submit" name="return" value="return"></p>
            </form>
            <?php exit();
    }  
    
    $query = "select Email, Pwd, Role 
              from User 
              where Email = ? and Pwd = ?";
    $stmt = $mysql->prepare($query);
    $stmt->bind_param('ss', $email, sha1($password));
    $stmt->execute();
    
    if(!$stmt) {
        echo "Cannot run query."; ?>
            <form method="post" action="Login_Page.php">
            <p><input type="submit" name="return" value="return"></p>
            </form>
            <?php exit();
    }
    
    $result = $stmt->get_result();
    $row = $result->fetch_row(); 
    $num_results = $result->num_rows;
    
    if ($num_results > 0) {
        if ($row[2] == "Admin") {
            header("Location: admin_page.php");
        }
        elseif ($row[2] == "Customer") {
            header("Location: customer_page.php?email=$email");
        }
    }
    else {
        echo "Unable to identify User Role"; ?>
            <form method="post" action="Login_Page.php">
            <p><input type="submit" name="return" value="return"></p>
            </form>
            <?php exit();
    }
  