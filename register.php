<!DOCTYPE html>
<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<html>
  <body>
    <div class="body-one">
    <h1>User Registeration</h1>
    <form method="post" action="registerScript.php" class="register">
      <label for="firstName" hidden>First Name:</label>
      <input type="text" id="firstName" name="firstName" placeholder="First Name" class="form-control" required><br>
      <label for="lastName" hidden>Last Name:</label>
      <input type="text" id="lastName" name="lastName" placeholder="Last Name" class="form-control" required><br>
      <label for="userName" hidden>Username:</label>
      <input type="text" id="userName" name="userName" placeholder="Username" class="form-control" required><br>
      <label for="email" hidden>Email: </label>
      <input type="email" id="email" name="email" placeholder="Email Address" class="form-control" required><br>
      <label for="password" hidden>Password:</label> 
      <input type="password" id="password" name="password" placeholder="Password" class="form-control" required><br>
      <input type="submit" value="Register" name="regSubmit" class="btn">
    </form>
    </div>
  </body>
</html>
<? include('includes/footer.php'); ?>