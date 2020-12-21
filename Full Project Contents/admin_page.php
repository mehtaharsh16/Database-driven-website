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
    <h1>Music</h1>
      <body>
        <div class="form">
        <h1>Insert Music</h1>
            <form method="post" action="insert_music.php">
            <p>Name: <input type="text" name="name"></p>
            <p>Price: <input type="text" name="price"></p>
            <p>Quantity: <input type="text" name="quantity"></p>
            <p>Description: <textarea id="description" name="description" rows="2" cols="40"></textarea></p>
            <p>Format: </p>
            <input type="radio" id="mp3" name="format" value="mp3">
                <label for="mp3">mp3</label><br>
            <input type="radio" id="WAV" name="format" value="WAV">
                <label for="WAV">WAV</label><br>
            <input type="radio" id="CD" name="format" value="CD">
                <label for="CD">CD</label><br>
            <input type="radio" id="Vinyl" name="format" value="Vinyl">
                <label for="Vinyl">Vinyl</label><br>
            <input type="radio" id="Cassette" name="format" value="Cassette">
                <label for="Cassette">Cassette</label><br>
                
            <p><input type="submit" name="submit" value="Insert"></p>
            </form>
        </div>
        
        <div class="form">
        <h1>Search Music</h1>
          <form action="music_search_results.php" method="post">
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
            <input type="submit" name="submit" value="Search">
          </form>
        </div>
        
        <div class="form">
        <h1>Delete Music</h1>
          <form method="post" action="delete_music_check.php">
            <p>ID: <input type="text" name="ID"></p>
            <input type="submit" name="delete" value="Delete">
          </form>
        </div>
        
        <div class="form">  
        <h1>Modify Music</h1>
          <form method="post" action="modify_music_check.php">
            <p>ID: <input type="text" name="ID"></p>
            <input type="submit" name="modify" value="Modify">
          </form>
        </div>
    </body>
  </div></center>
    
  <center><div class="column">
    <h1>Merchandise</h1>
      <body>
        <div class="form">
        <h1>Insert Merch</h1>
            <form method="post" action="insert_merch.php">
            <p>Name: <input type="text" name="name"></p>
            <p>Price: <input type="text" name="price"></p>
            <p>Quantity: <input type="text" name="quantity"></p>
            <p>Description: <textarea id="description" name="description" rows="2" cols="40"></textarea></p>
            <p>Type: </p>
            <input type="radio" id="clothing" name="type" value="clothing">
                <label for="clothing">clothing</label><br>
            <input type="radio" id="item" name="type" value="item">
                <label for="item">item</label><br>
            <p>Size (for clothing only): </p>
            <input type="radio" id="small" name="size" value="small">
                <label for="small">small</label><br>
            <input type="radio" id="large" name="size" value="large">
                <label for="large">large</label><br>
            <p><input type="submit" name="submit" value="Insert"></p>
            </form>
        </div>
        
        <div class="form">
        <h1>Search Merch</h1>
          <form action="merch_search_results.php" method="post">
            Select Type(s):<br />
            <input type="checkbox" id="clothing" name="type[]" value="clothing">
                <label for="clothing">clothing</label>
            <input type="checkbox" id="item" name="type[]" value="item">
                <label for="item">item</label>
            <p>Name:<br />
            <input name="name" type="text" size="40"></p>
            <input type="submit" name="search" value="Search">
          </form>
        </div>
        
        <div class="form">
        <h1>Delete Merch</h1>
          <form method="post" action="delete_merch_check.php">
            <p>ID: <input type="text" name="ID"></p>
            <input type="submit" name="delete" value="Delete">
          </form>
        </div>
        
        <div class="form">  
        <h1>Modify Merch</h1>
          <form method="post" action="modify_merch_check.php">
            <p>ID: <input type="text" name="ID"></p>
            <input type="submit" name="modify" value="Modify">
          </form>
        </div>
      </body>
  </div></center>
 
</html>