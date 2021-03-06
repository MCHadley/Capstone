<?php
// Start session
session_start();
// Turned off error reporting to get rid of missing index error
error_reporting(0);
// If the session is not logged in print logged in button, if logged in show users name and logout button
if(!$_SESSION['loggedin']){
  echo ('<a id="login-trigger" href="#">Log-in/Register</a>
          <div id="login-content">
            <form action="./login.php" method="POST">
              <label for="username" hidden>Username</label>
              <input id="username" type="text" name="username" placeholder="Username" required><br>
              <label for="passwordIn" hidden>Password</label>
              <input type="password" id="passwordIn" name="passwordIn" placeholder="Password" required><br>
              <input type="submit" id="logBtn" name="logBtn" value="Log in">
            </form>
            <a href="register.php">Register</a>
          </div>');
}else{
  echo '<p>Welcome '.$_SESSION['name'].'<br><form method="POST" action="logout.php" id="logout"><input type="submit" value="Logout" name="logout" class="btn"></form></p>';
}

if($_SESSION['level'] === 0){
  echo '<small>Admin</small>';
}

?>