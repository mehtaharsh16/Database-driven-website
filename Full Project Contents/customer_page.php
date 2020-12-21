<?php
    $email = $_GET['email'];
    if (empty($email)) {
        $email = $_POST['hid_email'];
    }
?>

<html>
<head>
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
</head>

  <center><div class="column">
    <h1>Buy Products</h1>
      <body>
          
        <div class="form">
        <h1>Search Music</h1>
          <form action="music_cart.php" method="post">
            Select Format(s):<br />
            <input type="checkbox" id="mp3" name="format[]" value="mp3">
                <label for="mp3">mp3</label>
            <input type="checkbox" id="WAV" name="format[]" value="WAV">
                <label for="WAV">WAV</label>
            <input type="checkbox" id="CD" name="format[]" value="CD">
                <label for="CD">CD</label>
            <input type="checkbox" id="Vinyl" name="format[]" value="Vinyl">
                <label for="Vinyl">Vinyl</label>
            <input type="checkbox" id="Casette" name="format[]" value="Casette">
                <label for="Casette">Casette</label>
            <p>Name:<br />
            <input name="Name" type="text" size="40"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            <input type="submit" name="submit" value="Search">
          </form>
        </div>
        
        <div class="form">
        <h1>Search Merch</h1>
          <form action="merch_cart.php" method="post">
            Select Type(s):<br />
            <input type="checkbox" id="clothing" name="type[]" value="clothing">
                <label for="clothing">clothing</label>
            <input type="checkbox" id="item" name="type[]" value="item">
                <label for="item">item</label>
            <p>Name:<br />
            <input name="name" type="text" size="40"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            <input type="submit" name="search" value="Search">
          </form>
        </div>
        
      </body>    
  </div></center>
    
  
  <center><div class="column">
    <h1>My Profile</h1>
      <body>
        
        <div class="form">  
          <h1>Update Profile</h1>
          <form method="post" action="modify_customer_profile_check.php">
            <p>Re-enter Login info to update: </p>
            <p>Email: <input type="text" name="email"></p>
            <p>Password: <input type="password" name="password"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            <input type="submit" name="modify_customer_profile" value="Update">
          </form>
        </div>
        
        <div class="form">
        <h1>My Cart</h1>
            <form method="post" action="modify_cart.php">
            <p><input type="submit" name="view" value="View/Edit"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
        </div>
          
        <div class="form">
        <h1>Past Orders</h1>
            <form method="post" action="view_receipts.php">
            <p><input type="submit" name="view" value="View"></p>
            <input type="hidden" id="hid_email" name="hid_email" value="<?php echo $email?>">
            </form>
        </div>
        
        
        
      </body>
  </div></center>
 
</html>