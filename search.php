<?php
include('includes/dbClass.php');
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
echo('<table><tr>
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
echo('</table>');

?>