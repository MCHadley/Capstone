<?php
//includes for header, navbar, and database
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbClass.php');
// new database connection
$db = new Db();
$connect = $db->connect();
//if the search form is filled out correctly submit form
if(isset($_POST['submit'])){
  //input from form, sanitize input, format it for SQL Query
  $input = $_POST['searchBox'];
  $querySan = $db->clean($input);
  $formatQ = '%'.$querySan.'%';
  // SQL Prepared query for id, title, and author. Print query with checkbox and dropdown box to add book to shelf and select reading status
  $stmt = $connect->prepare("SELECT books.book_id, books.title, authors.authorFirst, authors.authorLast FROM books
  INNER JOIN authors ON authors.author_id = books.author
  WHERE books.title LIKE ? OR authors.authorFirst LIKE ? OR authors.authorLast LIKE ?");
  $stmt->bind_param('sss', $formatQ, $formatQ, $formatQ);
  $stmt->execute();
  $result = $stmt->get_result();
  echo('<form action="output.php" method="POST"><table>
          <thead>
            <th></th>
            <th>Title</th>
            <th>Author</th>
          </thead>');
  while($books = $result->fetch_assoc()){
    $book[] = $books;
  }
  $count = 0;

  foreach($book as $list){
    $count++;
    $authorName = $list['authorFirst']." ".$list['authorLast'];
    echo('<tr>
            <td><input type="hidden" value='.$list['book_id'].' id="id" name="id[]"></td>
            <td>'.$list['title'].'</td>
            <td>'.$authorName.'</td>
            <td><select name="status[]">
              <option value="0"></option>
              <option value="1">Read</option>
              <option value="2">Reading</option>
              <option value="3">To-Read</option>
            </select></td>
            
          </tr>');
  }
}
echo('</table><input type="submit" value="submit" name="submit"></form>');
include('includes/footer.php');
?>