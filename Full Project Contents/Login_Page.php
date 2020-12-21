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
  <h1>Please Log In</h1>
    <form method="post" action="Login_Check.php">
      <p>Email: <input type="text" name="email"></p>
      <p>Password: <input type="password" name="password"></p>
      <p><input type="submit" name="submit" value="Log In"></p>
    </form>
</div></center>