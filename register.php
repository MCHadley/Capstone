<!DOCTYPE html>
<?php
include('includes/header.php');
include('includes/navbar.php');
?>
<html>
  <head>User Registeration</head>
  <body>
    <h1>User Registeration</h1>
    <form method="post" action="registerScript.php">
      <label for="firstName">First Name:</label>
      <input type="text" id="firstName" name="firstName" class="form-control"><br>
      <label for="lastName">Last Name:</label>
      <input type="text" id="lastName" name="lastName" class="form-control"><br>
      <label for="userName">Username:</label>
      <input type="text" id="userName" name="userName" class="form-control"><br>
      <label for="email">Email: </label>
      <input type="email" id="email" name="email" class="form-control"><br>
      <label for="password">Password:</label> 
      <input type="password" id="password" name="password" class="form-control"><br>
      <input type="submit" value="submit" name="regSubmit" class="btn">
    </form>
  </body>
</html>