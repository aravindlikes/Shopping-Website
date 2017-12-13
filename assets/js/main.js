$(document).ready(function() {
	$('.item.open').click(function(){
		$('.ui.sidebar').sidebar('setting', 'transition', 'overlay').sidebar('show');
	});
	$('.menu.top .item').tab();
	$('.ui.menu.top').find('.item').click(function(){
		localStorage.setItem('activeTab',$(this)[0].getAttribute("data-tab"));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab!=="null"){
		$('.ui.menu.top').find('.item').tab('change tab', activeTab);
	}
	else{
		activeTab=$('.ui.menu.top').find('.item')[0].getAttribute("data-tab");
		$('.ui.menu.top').find('.item').tab('change tab', activeTab);
	}	
	$('#single-slider').owlCarousel({
		loop:true,
		margin:10,
		autoplay:true,
		dots: true,
		responsiveClass:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	$("#preloader").fadeOut();
});