
$('#gallery-nav li a').click(function(event) {
  event.preventDefault();
  $("#gallery-nav li a.active").removeClass("active"); //Remove any "active" class
  $(this).addClass("active"); //Add "active" class to selected tab
  $('.gallery-links').hide().filter(this.getAttribute('href')).fadeIn();
  $('.gallery-links').css('position', 'relative');
  $('.gallery-links').css('left', 'auto');

});
