<header>
  <nav class="container">
    <div class="one">
      <li><a href="index.php" class="navLinks">Home</a></li>
    </div>
    <div class="two">
      <li><a href="bookshelf.php" class="navLinks">Bookshelf</a></li>
    </div>
    <div class="logo">
      <p>BookHub</p>
    </div>
    <div class="three">
      <li><a href="#" class="navLinks">Forums</a></li>
    </div>
    <div class="four">
      <ul>
        <li id="login">
          <a id="login-trigger" href="#">Log in</a>
          <div id="login-content">
            <form action="login.php" method="POST">
              <input id="username" type="username" name="username" placeholder="Username" required>
              <input type="password" id="password" name="password" placeholder="Password" required><br>
              <input type="submit" id="logBtn" name="logBtn" value="Log in">
            </form>
          </div>
        </li>
      </ul>
    </div>
  </nav>
</header>