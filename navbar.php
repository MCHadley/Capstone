<header>
  <nav class="container">
    <div class="one">
      <a href="index.php" class="navLinks">Home</a>
    </div>
    <div class="two">
      <a href="allbooks.php" class="navLinks">Bookshelf</a>
    </div>
    <div class="logo">
      <p>BookHub</p>
    </div>
    <div class="three">
      <a href="#" class="navLinks">Forums</a>
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