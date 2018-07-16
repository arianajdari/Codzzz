var window_height = $(window).height()-60;

$('.content').css('height',window_height);
$('#main_dashboard').css('min-height',window_height - 62);


$('header #signup,header #signin').on('click',function() {
	$(document).scrollTop(window_height * 3);
});


var scrollTopFunction = function () {
	var scroll = $(document).scrollTop();
	var window_height = $(window).height()-60;

	if(scroll >=0 && scroll < window_height)
	{
		$('header #content').css('background-color','#f3e9e7');
		$('header #content center').text('Hassle to develop?');
	}
	else if(scroll >= window_height && scroll < (2*window_height))
	{
		$('header #content').css('background-color','#becbed');
		$('header #content center').text('Sleek text editor');
	}
	else if(scroll >= (2*window_height) && scroll < (3*window_height))
	{
		$('header #content').css('background-color','#A6DFF8');
		$('header #content center').text('Stuck?');
	}
	else
	{
		$('header #content').css('background-color','#C1CBCF');
		$('header #content center').text('What are you waiting for?');
	}

};

scrollTopFunction();

document.onscroll = function() {
	scrollTopFunction();
};


