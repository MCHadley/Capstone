<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/footer.php');
include('includes/dbClass.php');
?>
<div class="body-container">
  <div class="body-one">
    <h1>Welcome to BookHub</h1>
    <p>BookHub is a simple way to keep track of the books you are reading along with a community.</p>
    <p>Books are added by users and you can add them to your lists!</p>
  </div>
  <div class="body-two">
    <form method="POST" action="">
      <input type="text" id="searchBox" name="searchBox" class="form-control"
        placeholder="Search for a book by title or author!">
      <input type="submit" value="Search" name="submit" class="btn">
    </form>
  </div>
<?php
if(isset($_POST['submit'])){
  $db = new Db();
  $connect = $db->connect();
  $input = $_POST['searchBox'];
  $querySan = $db->clean($input);
  $formatQ = '%'.$querySan.'%';

  $stmt = $connect->prepare("SELECT books.title, authors.authorFirst, authors.authorLast FROM books
  INNER JOIN authors ON authors.author_id = books.author
  WHERE books.title LIKE ? OR authors.authorFirst LIKE ? OR authors.authorLast LIKE ?");
  $stmt->bind_param('sss', $formatQ, $formatQ, $formatQ);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($title, $authorFirst, $authorLast);
  echo('<div class="body-four"><table><tr>
          <th>Title</th>
          <th>Author</th>
        </tr>');
  while($stmt->fetch()){
    $authorName = $authorFirst." ".$authorLast;
    printf("<tr>
            <td>%s</td>
            <td>%s</td>
          </tr>", $title, $authorName);
}
echo('</table></div>');
}else{
  
}
?>
</div>