document.addEventListener('DOMContentLoaded',()=>{
	const el = document.querySelector('.hero-slider .swiper');
	if(!el) return;

	new Swiper(el,{
		loop:true,
		autoplay:{ delay:4000 },
		effect:'fade',
		speed:800,
		pagination:{ el:'.swiper-pagination', clickable:true },
		navigation:{ nextEl:'.swiper-button-next', prevEl:'.swiper-button-prev' },
	});
});
