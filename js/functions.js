$(document).ready(function(){
 loginDrop();
 sortTable();
 activePage()
 formValid();
});

function loginDrop(){
  $('#login-trigger').click(function(){
    $(this).toggleClass('inactive');
    $(this).next('#login-content').slideToggle();          
  });
  $('#login p').click(function(){
    $('#logout').slideToggle();
  });
}

function sortTable(){
  $('.allbooks').click(function(){
    $('tr').show();
  });
  $('.read').click(function(){
    $('tr').show();
    $('table').find('tr').each(function(){
      $('tr:contains("Currently Reading"), tr:contains("To-Read")').hide();
    }); 
  });
  $('.reading').click(function(){
    $('table').find('tr').each(function(){
      $('tr').not(':first-of-type').hide();
      $('tr:contains("Reading")').show();
    });
  });
  $('.toread').click(function(){
    $('table').find('tr').each(function(){
      $('tr').not(':first-of-type').hide();
      $('tr:contains("To-Read")').show();
    });
  });
}

function activePage(){
  var url = window.location.pathname;
  var link = url.substr(url.lastIndexOf('/') + 1);
  $('.navLinks a').each(function(){
    if($(this).attr('href') == link){
      $(this).addClass('active');}
  });
}

function formValid(){
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