$(document).ready(function(){
 loginDrop();
});


function loginDrop(){
  $('#login-trigger').click(function(){
    $(this).toggleClass('inactive');
    $(this).next('#login-content').slideToggle();          
  });
}
