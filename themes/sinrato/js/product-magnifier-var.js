"use strict";
var sinrato_magnifier_vars;
var yith_magnifier_options = {
		sliderOptions: {
			responsive: sinrato_magnifier_vars.responsive,
			circular: sinrato_magnifier_vars.circular,
			infinite: sinrato_magnifier_vars.infinite,
			direction: 'up',
			debug: false,
			auto: false,
			align: 'left',
			height: "100%",
			width: 100,
			prev    : {
				button  : "#slider-prev",
				key     : "left"
			},
			next    : {
				button  : "#slider-next",
				key     : "right"
			},
			scroll : {
				items     : 1,
				pauseOnHover: true
			},
			items   : {
				visible: Number(sinrato_magnifier_vars.visible),
			},
			swipe : {
				onTouch:    true,
				onMouse:    true
			},
			mousewheel : {
				items: 1
			}
		},
		showTitle: false,
		zoomWidth: sinrato_magnifier_vars.zoomWidth,
		zoomHeight: sinrato_magnifier_vars.zoomHeight,
		position: sinrato_magnifier_vars.position,
		lensOpacity: sinrato_magnifier_vars.lensOpacity,
		softFocus: sinrato_magnifier_vars.softFocus,
		adjustY: 0,
		disableRightClick: false,
		phoneBehavior: sinrato_magnifier_vars.phoneBehavior,
		loadingLabel: sinrato_magnifier_vars.loadingLabel,
	};