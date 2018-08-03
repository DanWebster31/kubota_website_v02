

/*******************
PARALLAX
*******************/

function parallax(){
	var winWidth = $(window).width();
	if(winWidth > 768) {
		var scrolled = $(window).scrollTop();
		$('.parallax').css('margin-top', -(scrolled * 0.20) + 'px');
		$('.parallax-bg').css('background-position', 'center -' + (scrolled * 0.25) + 'px');
		$('.parallax-left').css('margin-left', '-' + (scrolled * 0.25) + 'px');
		$('.parallax-left h1').css('margin-left', (scrolled * 0.25) + 'px');
		$('.parallax-right').css('margin-left', (scrolled * 0.25) + 'px');
		$('.parallax-right h1').css('margin-left', '-' + (scrolled * 0.25) + 'px');
		// for parallax-right add to .slide >>> width: calc(100% + 225px); left: -225px!important;
	} else {
		$('.parallax').css('margin-top', 0);
		$('.parallax-bg').css('background-position', 'center');
		$('.parallax-left').css('margin-left', 0);
		$('.parallax-left h1').css('margin-left', 0);
		$('.parallax-right').css('margin-left', '0');
		$('.parallax-right').css('left', '0');
	}

}

/*******************
SCROLL
*******************/

function goToByScroll(id){
     	$('html,body').animate({scrollTop: $("#"+id).offset().top-75},1000);
}

$('a.scrollto').click(function(event) {
	event.preventDefault();
	id = $(this).attr('href').replace(new RegExp('#', 'g'),"");
	goToByScroll(id);
});

checkScroll = function() {
	var snipeHeight = $('#slider').height();
	if ($(this).scrollTop() > snipeHeight - 200) {
		$('header').addClass("gosmall");
		$('#slider').addClass("gosmall");
	} else {
		$('.gosmall').removeClass("gosmall");
	}

	if ($(this).scrollTop() > snipeHeight) {
		$('#slidergrad-top').css("position","absolute");
	} else {
		$('#slidergrad-top').css("position","fixed");
	}


	if ($(this).scrollTop() > 1000) {
		$('#uplink:hidden').stop(true, true).fadeIn('slow');
	} else {
		$('#uplink').stop(true, true).fadeOut('slow');
	}
};

/*******************
SCROLL REVEAL
*******************/

var fade = {
	origin: 'bottom',
	distance: '0',
	duration: 1000,
	delay: 200,
	rotate: { x : 0, y : 0, z : 0 },
	opacity: 0,
	scale: 0,
	easing: 'ease-out',
	//container: null,
	mobile: false,
	reset: true,
	useDelay: 'always',
	viewFactor: 0.1,
	viewOffset: { top : 0, right : 0, bottom : 0, left : 0 },
	afterReveal: function( domEl ){},
	afterReset: function( domEl ){}
};

var pushleft = {
	origin: 'right',
	distance: '50px',
	duration: 500,
	delay: 200,
	rotate: { x : 0, y : 0, z : 0 },
	opacity: 0,
	scale: 0,
	easing: 'ease-out',
	//container: null,
	mobile: false,
	reset: true,
	useDelay: 'always',
	viewFactor: 0.05,
	viewOffset: { top : 0, right : 0, bottom : 0, left : 0 },
	afterReveal: function( domEl ){},
	afterReset: function( domEl ){}
};

var pushright = {
	origin: 'left',
	distance: '50px',
	duration: 500,
	delay: 200,
	rotate: { x : 0, y : 0, z : 0 },
	opacity: 0,
	scale: 0,
	easing: 'ease-out',
	//container: null,
	mobile: false,
	reset: true,
	useDelay: 'always',
	viewFactor: 0.05,
	viewOffset: { top : 0, right : 0, bottom : 0, left : 0 },
	afterReveal : function( domEl ){},
	afterReset  : function( domEl ){}
};

var pushupfp = {
	origin: 'bottom',
	distance: '50px',
	duration: 500,
	delay: 200,
	rotate: { x : 0, y : 0, z : 0 },
	opacity: 0,
	scale: 0,
	easing: 'ease-out',
	//container: null,
	mobile: false,
	reset: true,
	useDelay: 'always',
	viewFactor: 0.1,
	viewOffset: { top : 0, right : 0, bottom : 0, left : 0 },
	afterReveal: function( domEl ){},
	afterReset: function( domEl ){}
};


window.sr = ScrollReveal();
//sr.reveal( '.foo', pushleft);
sr.reveal( '.fade', fade );
sr.reveal( '.pushleft', pushleft );
sr.reveal( '.pushright', pushright );
sr.reveal( '.pushupfp', pushupfp );

$( document ).ready(function() {

  $("a#header-menu-toggle").click(function(){
  		$("#mainmenu").toggleClass("open");
  		$("#header-menu-toggle").toggleClass("open");
			if($("#header-menu-toggle").is(".open")) {
				$(this).html('<img src="/wp-content/themes/client-theme/images/global/icon-close.svg">');
			} else {
				$(this).html('<img class="stretch left" src="/wp-content/themes/client-theme/images/global/icon-hamburger.svg"><span class="full left">MENU</span>');
			}
	});

	$("#menu-home-menu li").click(function(){
		$("a#header-menu-toggle").click();
	});


	// Run Parallax if fullscreen if not on Iphone/IPad
	var deviceAgent = navigator.userAgent.toLowerCase();
	var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);

	checkScroll();

	$(window).scroll(function(e){
		checkScroll();
		if($(window).width() >= 768 && !agentID){
	    	parallax();
		} else {

		}
	});

// if($(window).width() >= 768 && !agentID) {
// 	// Call Scroll Reveal
// 	window.sr = ScrollReveal();
// 	sr.reveal('.fade-slow', fadeSlow);
// 	sr.reveal('.from-bottom', frombottom);
// 	sr.reveal('.from-left', fromleft);
// 	sr.reveal('.from-right', fromright);
// 	sr.reveal('.from-top', fromtop);
// 	sr.reveal('.small-to-big', smalltobig);
// 	// Make sure you have the latest scroll reveal to use the sequence feature
// 	sr.reveal('.fade-sequence-2', fadeSequence, 400);
// 	sr.reveal('.fade-sequence-fast', fadeSequence, 150);
// 	sr.reveal('.gallery-box', fadeSequence, 400);
// 	} else {
// 	}
}); // end doc ready
