$(document).ready(function(){
 loginDrop();
 sortTable();
 activePage()
 formValid();
 formDrop();
 shelfStatus();
 updateShelf();
//  realVerify();
nytBooks();
});

function loginDrop(){ // Dropdown box for the login form on the navbar
  $('#login-trigger').click(function(){
    $(this).toggleClass('inactive');
    $(this).next('#login-content').slideToggle();          
  });
  $('#login p').click(function(){
    $('#logout').slideToggle();
  });
}

function sortTable(){ // Sorting for booklist
  $('.allbooks').click(function(){
    $('tr').show();
  });
  $('.read').click(function(){ // Show read books
    $('tr').show();
    $('table').find('tr').each(function(){
      $('tr:contains("Currently Reading"), tr:contains("To-Read")').hide();
    }); 
  });
  $('.reading').click(function(){ // Show reading books
    $('table').find('tr').each(function(){
      $('tr').not(':first-of-type').hide();
      $('tr:contains("Reading")').show();
    });
  });
  $('.toread').click(function(){ // Show books to be read
    $('table').find('tr').each(function(){
      $('tr').not(':first-of-type').hide();
      $('tr:contains("To-Read")').show();
    });
  });
}

function activePage(){ // Highlight active link
  var url = window.location.pathname;
  var link = url.substr(url.lastIndexOf('/') + 1);
  $('.navLinks a').each(function(){
    if($(this).attr('href') == link){
      $(this).addClass('active');}
  });
}

function formValid(){ // form validation
  $('.register').validate({
    rules: {
      firstName: "required",
      lastName: "required",
      userName: "required",
      email: {
        required: true,
        email: true
      }
    }
  });
}

function formDrop(){ // dropdown for adding book in bookshelf
  $('#addBook').css('display', 'none');
  $('#addBook').click(function(){
    $(this).toggleClass('active');
    $(this).next('#login-content').slideToggle();          
  });
  $('#bookLink').click(function(){
    $('#addBook').slideToggle();
  });
}

function shelfStatus(){ // changes book shelf TD to dropdown with status
  $('.shelf').css('cursor', 'pointer');
  $('.shelf').one('click',(function(){
    $(this).html('<form><select name="status" class="status"><option value="0"></option><option value="1">Read</option><option value="2">Reading</option><option value="3">To-Read</option></select></form>');
    }));
}

function updateShelf(){ // updates book status on click
  $('.shelf').change(function(){
    var status = $('.status').val();
    var bookId = $(this).siblings(":hidden").html();
    $.ajax({
      type: "POST",
      url: 'updateStatus.php',
      data: {status, bookId},
      success: function(){
        location.reload();
      }
    })
  });
}

function realVerify(){ // Google captcha
  grecaptcha.ready(function() {
    grecaptcha.execute('6LcJxp8UAAAAAHGGzsAiabWgKa3V1Yp2JG2TU3NN', {action: 'homepage'}).then(function(token) {
      var response = document.getElementById('recaptchaResponse');
      response.value = token;
    });
  });
}

function nytBooks(){ // Get NYT Bestsellers
  var url = window.location.pathname;
  var link = url.substr(url.lastIndexOf('/') + 1);
  if(link === 'bestsellers.php'){
    var apiKey = '7hClboiI1GzOdB9xMRBoqlsxlZVSVAlK';
    fetch('https://api.nytimes.com/svc/books/v3/lists.json?list-name=hardcover-fiction&api-key=' + apiKey, {
      method: 'get',
    })
    .then(response => { return response.json(); })
    .then(json => { updateBestSellers(json); console.log(json)})
  }
}

function updateBestSellers(nytBooks){ // Print NYT Bestseller list
  nytBooks.results.forEach(function(book){
    var bookInfo = book.book_details[0];
    var lastWeekRank = book.rank_last_week || 'n/a';
    var weeksOnList = book.weeks_on_list || 'New this week!';
    var listing = '<div id="' + book.rank + '" class="entry">' + 
    '<p>' + book.rank + 
    '</p>' + 
    '<h2><a href="' + book.amazon_product_url + '" target="_blank">' + bookInfo.title + '</a></h2>' +
    '<h4>By ' + bookInfo.author + '</h4>' +
    '<h4 class="publisher">' + bookInfo.publisher + '</h4>' +
    '<p>' + bookInfo.description + '</p>' + 
    '<div class="stats">' + 
      '<p>Last Week: ' + lastWeekRank + '</p>' + 
      '<p>Weeks on list: ' + weeksOnList + '</p>' +
      '<hr>' +
    '</div>' +
  '</div>';
  $('#best-seller-titles').append(listing);
  });
}