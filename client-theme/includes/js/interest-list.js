/********************************************************
 FORM
********************************************************/

// Amount to Offset Scroll (If Necessary)
var headeroffset = 0;

// email validation
function isEmail(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

$('#submitbutton').click(function(event) {

  // remove required and disable default
  $('.required-highlight').removeClass('required-highlight');
  event.preventDefault();

  // j is the check number
  var j = 0;
  $('[required]').each(function() {

    // text

    if ($(this).is("input:text")) {
      var self = $(this);
      if(!$.trim($(this).val())) {
        $("#errorchecking").slideDown(500);
        $(this).addClass('required-highlight');
        if (j == 0) {
          $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
            //$(this).focus();
          });
        }
        j++;
        //console.log ('text check');
      }
    }

    // email

    if ($(this).attr('type') == 'email') {
      var self = $(this);
      if( !isEmail($(this).val()) ) {
        $("#errorchecking").slideDown(500);
        $(this).addClass('required-highlight');
        if (j == 0) {
          $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
            //$(self).focus();
          });
        }
        j++;
        //console.log ('email check');
      }
    }

    // radio buttons

    if ($(this).is("input:radio")) {
      var self = $(this);
      if (self.is(':not(:checked)') && $('input[name=' + self.attr('name') + ']:checked').length === 0) {
        $("#errorchecking").slideDown(500);
        $(this).parent().parent().addClass('required-highlight');
        if (j == 0) {
          $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
            //$(self).focus();
          });
        }
        j++;
        //console.log ('radio check');
      }
    }

    // checkboxes

    if ($(this).is("input:checkbox")) {
      var self = $(this);
      if (self.is(':not(:checked)') && $('input[name=' + self.attr('name') + ']:checked').length === 0) {
        $("#errorchecking").slideDown(500);
        $(this).parent().parent().addClass('required-highlight');
        if (j == 0) {
          $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
            //$(self).focus();
          });
        }
        j++;
        //console.log ('check check');
      }
    }

    // select

    if ($(this).is("select")) {
      if(!$.trim($(this).val())) {
        $("#errorchecking").slideDown(500);
        $(this).addClass('required-highlight');
        if (j == 0) {
          $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
            //$(self).focus();
          });
        }
        j++;
        //console.log ('select check');
      }
    }

  });

  if (!j) {

  var iheight = $('#interest-list').outerHeight();
  $('#interest-list').css('height', iheight + "px");

  $('#interest-list').fadeOut(1000, function(){
    $(this).empty();
    $(this).html('<div id="process"><h4>Processing</h4><p>Please wait a moment.</p></div>');
    $(this).fadeIn();
  });

  $('html,body').animate({scrollTop: $('#interest-list').offset().top - headeroffset},1000, function(){
    var pheight = $('#process').outerHeight();
    $('#interest-list').animate({ height: pheight }, 1000 );
  });

  var dataString = $('#interest-list').serialize();
  console.log(dataString);

      $.ajax({
        type: "POST",
        url: "/admin/webservice/index.php",
        data: dataString,
        success: function() {

            $('#interest-list').fadeOut(function() {
              $(this).empty();
              $(this).html('<div id="success"><h4>Thank you for your interest.</h4><p>Your information has been received.</p></div>');
              $('#interest-list')[0].reset();
              $('#interest-list').fadeIn();
              //ga('send', 'event', 'Contact', 'Submission', 'Interest List');
            });
          }
      });

  }

});
