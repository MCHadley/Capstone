$(document).ready(function(){
 loginDrop();
 sortTable();
});

function loginDrop(){
  $('#login-trigger').click(function(){
    $(this).toggleClass('inactive');
    $(this).next('#login-content').slideToggle();          
  });
  $('#logout').delay(2000).slideUp();
  $('#login p').click(function(){
    $('#logout').slideToggle();
  });
}

function sortTable(){
  $('.allbooks').click(function(){
    $('tr').show();
  });
  $('.read').click(function(){
    $('table').find('tr').each(function(){
      $('tr:contains("Currently Reading"), tr:contains("To-Read")').hide();
    }); 
  });
  $('.reading').click(function(){
    $('table').find('tr').each(function(){
      $('tr').show();
      $('tr:contains("To-Read")').hide();
    });
  });
  $('.toread').click(function(){
    $('table').find('tr').each(function(){
      $('tr').show();
      $('tr:contains("Currently Reading")').hide();
    });
  });
}