// Sticky navigation with content section highlight.

// Help from https://github.com/davist11/jQuery-One-Page-Nav and http://jqueryfordesigners.com/fixed-floating-elements/



$('#locations-nav li a').click(function(event) {
  event.preventDefault();
  $("#locations-nav li a.active").removeClass("active"); //Remove any "active" class
  $(this).addClass("active"); //Add "active" class to selected tab
  $('.locations-links').hide().filter(this.getAttribute('href')).fadeIn();
});


$(document).ready(function() {

  $('#menu-home-menu').onePageNav({
    scrollThreshold: 0.2, // Adjust if Navigation highlights too early or too late
    offsetHeight: 75, //Height of Navigation Bar
    currentClass: 'active',
    changeHash: false,
    begin: function() { },
    end: function() { },
    scrollChange: function($currentListItem) { }
  });

  if(window.location.hash) {
    var hash = window.location.hash.substring(1);
    if(jQuery('a[href="#'+hash+'"]','#menu-home-menu').length>0){
      jQuery('html, body').animate({
          scrollTop: jQuery("#"+hash).offset().top - 75
      }, 1000);
      var href = window.location.href;
      newUrl = href.substring(0, href.indexOf('#'));
      window.history.replaceState({}, '', newUrl);
    }
  }

});
