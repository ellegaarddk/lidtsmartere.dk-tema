<?php


// create icon field
function icon_field($settings, $value)
{
	$dependency = vc_generate_dependencies_attributes($settings);
	$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
	$type = isset($settings['type']) ? $settings['type'] : '';
	$class = isset($settings['class']) ? $settings['class'] : '';
	$icons = array(
		
		'arrows-anticlockwise',
		'arrows-anticlockwise-dashed',
		'arrows-button-down',
		'arrows-button-off',
		'arrows-button-on',
		'arrows-button-up',
		'arrows-check',
		'arrows-circle-check',
		'arrows-circle-down',
		'arrows-circle-downleft',
		'arrows-circle-downright',
		'arrows-circle-left',
		'arrows-circle-minus',
		'arrows-circle-plus',
		'arrows-circle-remove',
		'arrows-circle-right',
		'arrows-circle-up',
		'arrows-circle-upleft',
		'arrows-circle-upright',
		'arrows-clockwise',
		'arrows-clockwise-dashed',
		'arrows-compress',
		'arrows-deny',
		'arrows-diagonal',
		'arrows-diagonal2',
		'arrows-down',
		'arrows-down-double',
		'arrows-downleft',
		'arrows-downright',
		'arrows-drag-down',
		'arrows-drag-down-dashed',
		'arrows-drag-horiz',
		'arrows-drag-left',
		'arrows-drag-left-dashed',
		'arrows-drag-right',
		'arrows-drag-right-dashed',
		'arrows-drag-up',
		'arrows-drag-up-dashed',
		'arrows-drag-vert',
		'arrows-exclamation',
		'arrows-expand',
		'arrows-expand-diagonal1',
		'arrows-expand-horizontal1',
		'arrows-expand-vertical1',
		'arrows-fit-horizontal',
		'arrows-fit-vertical',
		'arrows-glide',
		'arrows-glide-horizontal',
		'arrows-glide-vertical',
		'arrows-hamburger1',
		'arrows-hamburger-2',
		'arrows-horizontal',
		'arrows-info',
		'arrows-keyboard-alt',
		'arrows-keyboard-cmd',
		'arrows-keyboard-delete',
		'arrows-keyboard-down',
		'arrows-keyboard-left',
		'arrows-keyboard-return',
		'arrows-keyboard-right',
		'arrows-keyboard-shift',
		'arrows-keyboard-tab',
		'arrows-keyboard-up',
		'arrows-left',
		'arrows-left-double-32',
		'arrows-minus',
		'arrows-move',
		'arrows-move2',
		'arrows-move-bottom',
		'arrows-move-left',
		'arrows-move-right',
		'arrows-move-top',
		'arrows-plus',
		'arrows-question',
		'arrows-remove',
		'arrows-right',
		'arrows-right-double',
		'arrows-rotate',
		'arrows-rotate-anti',
		'arrows-rotate-anti-dashed',
		'arrows-rotate-dashed',
		'arrows-shrink',
		'arrows-shrink-diagonal1',
		'arrows-shrink-diagonal2',
		'arrows-shrink-horizonal2',
		'arrows-shrink-horizontal1',
		'arrows-shrink-vertical1',
		'arrows-shrink-vertical2',
		'arrows-sign-down',
		'arrows-sign-left',
		'arrows-sign-right',
		'arrows-sign-up',
		'arrows-slide-down1',
		'arrows-slide-down2',
		'arrows-slide-left1',
		'arrows-slide-left2',
		'arrows-slide-right1',
		'arrows-slide-right2',
		'arrows-slide-up1',
		'arrows-slide-up2',
		'arrows-slim-down',
		'arrows-slim-down-dashed',
		'arrows-slim-left',
		'arrows-slim-left-dashed',
		'arrows-slim-right',
		'arrows-slim-right-dashed',
		'arrows-slim-up',
		'arrows-slim-up-dashed',
		'arrows-square-check',
		'arrows-square-down',
		'arrows-square-downleft',
		'arrows-square-downright',
		'arrows-square-left',
		'arrows-square-minus',
		'arrows-square-plus',
		'arrows-square-remove',
		'arrows-square-right',
		'arrows-square-up',
		'arrows-square-upleft',
		'arrows-square-upright',
		'arrows-squares',
		'arrows-stretch-diagonal1',
		'arrows-stretch-diagonal2',
		'arrows-stretch-diagonal3',
		'arrows-stretch-diagonal4',
		'arrows-stretch-horizontal1',
		'arrows-stretch-horizontal2',
		'arrows-stretch-vertical1',
		'arrows-stretch-vertical2',
		'arrows-switch-horizontal',
		'arrows-switch-vertical',
		'arrows-up',
		'arrows-up-double-33',
		'arrows-upleft',
		'arrows-upright',
		'arrows-vertical',
		
		'basic-accelerator',
		'basic-alarm',
		'basic-anchor',
		'basic-anticlockwise',
		'basic-archive',
		'basic-archive-full',
		'basic-ban',
		'basic-battery-charge',
		'basic-battery-empty',
		'basic-battery-full',
		'basic-battery-half',
		'basic-bolt',
		'basic-book',
		'basic-book-pen',
		'basic-book-pencil',
		'basic-bookmark',
		'basic-calculator',
		'basic-calendar',
		'basic-cards-diamonds',
		'basic-cards-hearts',
		'basic-case',
		'basic-chronometer',
		'basic-clessidre',
		'basic-clock',
		'basic-clockwise',
		'basic-cloud',
		'basic-clubs',
		'basic-compass',
		'basic-cup',
		'basic-diamonds',
		'basic-display',
		'basic-download',
		'basic-exclamation',
		'basic-eye',
		'basic-eye-closed',
		'basic-female',
		'basic-flag1',
		'basic-flag2',
		'basic-floppydisk',
		'basic-folder',
		'basic-folder-multiple',
		'basic-gear',
		'basic-geolocalize-01',
		'basic-geolocalize-05',
		'basic-globe',
		'basic-gunsight',
		'basic-hammer',
		'basic-headset',
		'basic-heart',
		'basic-heart-broken',
		'basic-helm',
		'basic-home',
		'basic-info',
		'basic-ipod',
		'basic-joypad',
		'basic-key',
		'basic-keyboard',
		'basic-laptop',
		'basic-life-buoy',
		'basic-lightbulb',
		'basic-link',
		'basic-lock',
		'basic-lock-open',
		'basic-magic-mouse',
		'basic-magnifier',
		'basic-magnifier-minus',
		'basic-magnifier-plus',
		'basic-mail',
		'basic-mail-multiple',
		'basic-mail-open',
		'basic-mail-open-text',
		'basic-male',
		'basic-map',
		'basic-message',
		'basic-message-multiple',
		'basic-message-txt',
		'basic-mixer2',
		'basic-mouse',
		'basic-notebook',
		'basic-notebook-pen',
		'basic-notebook-pencil',
		'basic-paperplane',
		'basic-pencil-ruler',
		'basic-pencil-ruler-pen',
		'basic-photo',
		'basic-picture',
		'basic-picture-multiple',
		'basic-pin1',
		'basic-pin2',
		'basic-postcard',
		'basic-postcard-multiple',
		'basic-printer',
		'basic-question',
		'basic-rss',
		'basic-server',
		'basic-server2',
		'basic-server-cloud',
		'basic-server-download',
		'basic-server-upload',
		'basic-settings',
		'basic-share',
		'basic-sheet',
		'basic-sheet-multiple',
		'basic-sheet-pen',
		'basic-sheet-pencil',
		'basic-sheet-txt',
		'basic-signs',
		'basic-smartphone',
		'basic-spades',
		'basic-spread',
		'basic-spread-bookmark',
		'basic-spread-text',
		'basic-spread-text-bookmark',
		'basic-star',
		'basic-tablet',
		'basic-target',
		'basic-todo',
		'basic-todo-pen',
		'basic-todo-pencil',
		'basic-todo-txt',
		'basic-todolist-pen',
		'basic-todolist-pencil',
		'basic-trashcan',
		'basic-trashcan-full',
		'basic-trashcan-refresh',
		'basic-trashcan-remove',
		'basic-upload',
		'basic-usb',
		'basic-video',
		'basic-watch',
		'basic-webpage',
		'basic-webpage-img-txt',
		'basic-webpage-multiple',
		'basic-webpage-txt',
		'basic-world',
		
		'basic-elaboration-bookmark-checck',
		'basic-elaboration-bookmark-minus',
		'basic-elaboration-bookmark-plus',
		'basic-elaboration-bookmark-remove',
		'basic-elaboration-briefcase-check',
		'basic-elaboration-briefcase-download',
		'basic-elaboration-briefcase-flagged',
		'basic-elaboration-briefcase-minus',
		'basic-elaboration-briefcase-plus',
		'basic-elaboration-briefcase-refresh',
		'basic-elaboration-briefcase-remove',
		'basic-elaboration-briefcase-search',
		'basic-elaboration-briefcase-star',
		'basic-elaboration-briefcase-upload',
		'basic-elaboration-browser-check',
		'basic-elaboration-browser-download',
		'basic-elaboration-browser-minus',
		'basic-elaboration-browser-plus',
		'basic-elaboration-browser-refresh',
		'basic-elaboration-browser-remove',
		'basic-elaboration-browser-search',
		'basic-elaboration-browser-star',
		'basic-elaboration-browser-upload',
		'basic-elaboration-calendar-check',
		'basic-elaboration-calendar-cloud',
		'basic-elaboration-calendar-download',
		'basic-elaboration-calendar-empty',
		'basic-elaboration-calendar-flagged',
		'basic-elaboration-calendar-heart',
		'basic-elaboration-calendar-minus',
		'basic-elaboration-calendar-next',
		'basic-elaboration-calendar-noaccess',
		'basic-elaboration-calendar-pencil',
		'basic-elaboration-calendar-plus',
		'basic-elaboration-calendar-previous',
		'basic-elaboration-calendar-refresh',
		'basic-elaboration-calendar-remove',
		'basic-elaboration-calendar-search',
		'basic-elaboration-calendar-star',
		'basic-elaboration-calendar-upload',
		'basic-elaboration-cloud-check',
		'basic-elaboration-cloud-download',
		'basic-elaboration-cloud-minus',
		'basic-elaboration-cloud-noaccess',
		'basic-elaboration-cloud-plus',
		'basic-elaboration-cloud-refresh',
		'basic-elaboration-cloud-remove',
		'basic-elaboration-cloud-search',
		'basic-elaboration-cloud-upload',
		'basic-elaboration-document-check',
		'basic-elaboration-document-cloud',
		'basic-elaboration-document-download',
		'basic-elaboration-document-flagged',
		'basic-elaboration-document-graph',
		'basic-elaboration-document-heart',
		'basic-elaboration-document-minus',
		'basic-elaboration-document-next',
		'basic-elaboration-document-noaccess',
		'basic-elaboration-document-note',
		'basic-elaboration-document-pencil',
		'basic-elaboration-document-picture',
		'basic-elaboration-document-plus',
		'basic-elaboration-document-previous',
		'basic-elaboration-document-refresh',
		'basic-elaboration-document-remove',
		'basic-elaboration-document-search',
		'basic-elaboration-document-star',
		'basic-elaboration-document-upload',
		'basic-elaboration-folder-check',
		'basic-elaboration-folder-cloud',
		'basic-elaboration-folder-document',
		'basic-elaboration-folder-download',
		'basic-elaboration-folder-flagged',
		'basic-elaboration-folder-graph',
		'basic-elaboration-folder-heart',
		'basic-elaboration-folder-minus',
		'basic-elaboration-folder-next',
		'basic-elaboration-folder-noaccess',
		'basic-elaboration-folder-note',
		'basic-elaboration-folder-pencil',
		'basic-elaboration-folder-picture',
		'basic-elaboration-folder-plus',
		'basic-elaboration-folder-previous',
		'basic-elaboration-folder-refresh',
		'basic-elaboration-folder-remove',
		'basic-elaboration-folder-search',
		'basic-elaboration-folder-star',
		'basic-elaboration-folder-upload',
		'basic-elaboration-mail-check',
		'basic-elaboration-mail-cloud',
		'basic-elaboration-mail-document',
		'basic-elaboration-mail-download',
		'basic-elaboration-mail-flagged',
		'basic-elaboration-mail-heart',
		'basic-elaboration-mail-next',
		'basic-elaboration-mail-noaccess',
		'basic-elaboration-mail-note',
		'basic-elaboration-mail-pencil',
		'basic-elaboration-mail-picture',
		'basic-elaboration-mail-previous',
		'basic-elaboration-mail-refresh',
		'basic-elaboration-mail-remove',
		'basic-elaboration-mail-search',
		'basic-elaboration-mail-star',
		'basic-elaboration-mail-upload',
		'basic-elaboration-message-check',
		'basic-elaboration-message-dots',
		'basic-elaboration-message-happy',
		'basic-elaboration-message-heart',
		'basic-elaboration-message-minus',
		'basic-elaboration-message-note',
		'basic-elaboration-message-plus',
		'basic-elaboration-message-refresh',
		'basic-elaboration-message-remove',
		'basic-elaboration-message-sad',
		'basic-elaboration-smartphone-cloud',
		'basic-elaboration-smartphone-heart',
		'basic-elaboration-smartphone-noaccess',
		'basic-elaboration-smartphone-note',
		'basic-elaboration-smartphone-pencil',
		'basic-elaboration-smartphone-picture',
		'basic-elaboration-smartphone-refresh',
		'basic-elaboration-smartphone-search',
		'basic-elaboration-tablet-cloud',
		'basic-elaboration-tablet-heart',
		'basic-elaboration-tablet-noaccess',
		'basic-elaboration-tablet-note',
		'basic-elaboration-tablet-pencil',
		'basic-elaboration-tablet-picture',
		'basic-elaboration-tablet-refresh',
		'basic-elaboration-tablet-search',
		'basic-elaboration-todolist-2',
		'basic-elaboration-todolist-check',
		'basic-elaboration-todolist-cloud',
		'basic-elaboration-todolist-download',
		'basic-elaboration-todolist-flagged',
		'basic-elaboration-todolist-minus',
		'basic-elaboration-todolist-noaccess',
		'basic-elaboration-todolist-pencil',
		'basic-elaboration-todolist-plus',
		'basic-elaboration-todolist-refresh',
		'basic-elaboration-todolist-remove',
		'basic-elaboration-todolist-search',
		'basic-elaboration-todolist-star',
		'basic-elaboration-todolist-upload',
		
		'ecommerce-bag',
		'ecommerce-bag-check',
		'ecommerce-bag-cloud',
		'ecommerce-bag-download',
		'ecommerce-bag-minus',
		'ecommerce-bag-plus',
		'ecommerce-bag-refresh',
		'ecommerce-bag-remove',
		'ecommerce-bag-search',
		'ecommerce-bag-upload',		
		'ecommerce-banknote',
		'ecommerce-banknotes',
		'ecommerce-basket',
		'ecommerce-basket-check',
		'ecommerce-basket-cloud',
		'ecommerce-basket-download',
		'ecommerce-basket-minus',
		'ecommerce-basket-plus',
		'ecommerce-basket-refresh',
		'ecommerce-basket-remove',		
		'ecommerce-basket-search',
		'ecommerce-basket-upload',
		'ecommerce-bath',
		'ecommerce-cart',
		'ecommerce-cart-check',
		'ecommerce-cart-cloud',
		'ecommerce-cart-content',
		'ecommerce-cart-download',
		'ecommerce-cart-minus',
		'ecommerce-cart-plus',		
		'ecommerce-cart-refresh',
		'ecommerce-cart-remove',
		'ecommerce-cart-search',
		'ecommerce-cart-upload',
		'ecommerce-cent',
		'ecommerce-colon',
		'ecommerce-creditcard',
		'ecommerce-diamond',
		'ecommerce-dollar',
		'ecommerce-euro',		
		'ecommerce-franc',
		'ecommerce-gift',
		'ecommerce-graph1',
		'ecommerce-graph2',
		'ecommerce-graph3',
		'ecommerce-graph-decrease',
		'ecommerce-graph-increase',
		'ecommerce-guarani',
		'ecommerce-kips',
		'ecommerce-lira',		
		'ecommerce-megaphone',
		'ecommerce-money',
		'ecommerce-naira',
		'ecommerce-pesos',
		'ecommerce-pound',
		'ecommerce-receipt',
		'ecommerce-receipt-bath',
		'ecommerce-receipt-cent',
		'ecommerce-receipt-dollar',
		'ecommerce-receipt-euro',		
		'ecommerce-receipt-franc',
		'ecommerce-receipt-guarani',
		'ecommerce-receipt-kips',
		'ecommerce-receipt-lira',
		'ecommerce-receipt-naira',
		'ecommerce-receipt-pesos',
		'ecommerce-receipt-pound',
		'ecommerce-receipt-rublo',
		'ecommerce-receipt-rupee',
		'ecommerce-receipt-tugrik',		
		'ecommerce-receipt-won',
		'ecommerce-receipt-yen',
		'ecommerce-receipt-yen2',
		'ecommerce-recept-colon',
		'ecommerce-rublo',
		'ecommerce-rupee',
		'ecommerce-safe',
		'ecommerce-sale',
		'ecommerce-sales',
		'ecommerce-ticket',		
		'ecommerce-tugriks',
		'ecommerce-wallet',
		'ecommerce-won',
		'ecommerce-yen',
		'ecommerce-yen2',
		
		'music-beginning-button',
		'music-bell',
		'music-cd',
		'music-diapason',
		'music-eject-button',
		'music-end-button',
		'music-fastforward-button',
		'music-headphones',
		'music-ipod',
		'music-loudspeaker',
		'music-microphone',
		'music-microphone-old',
		'music-mixer',
		'music-mute',
		'music-note-multiple',
		'music-note-single',
		'music-pause-button',
		'music-play-button',
		'music-playlist',
		'music-radio-ghettoblaster',
		'music-radio-portable',
		'music-record',
		'music-recordplayer',
		'music-repeat-button',
		'music-rewind-button',
		'music-shuffle-button',
		'music-stop-button',
		'music-tape',
		'music-volume-down',
		'music-volume-up',
		
		'software-add-vectorpoint',
		'software-box-oval',
		'software-box-polygon',
		'software-box-rectangle',
		'software-box-roundedrectangle',
		'software-character',
		'software-crop',
		'software-eyedropper',
		'software-font-allcaps',
		'software-font-baseline-shift',
		'software-font-horizontal-scale',
		'software-font-kerning',
		'software-font-leading',
		'software-font-size',
		'software-font-smallcapital',
		'software-font-smallcaps',
		'software-font-strikethrough',
		'software-font-tracking',
		'software-font-underline',
		'software-font-vertical-scale',
		'software-horizontal-align-center',
		'software-horizontal-align-left',
		'software-horizontal-align-right',
		'software-horizontal-distribute-center',
		'software-horizontal-distribute-left',
		'software-horizontal-distribute-right',
		'software-indent-firstline',
		'software-indent-left',
		'software-indent-right',
		'software-lasso',
		'software-layers1',
		'software-layers2',
		'software-layout',
		'software-layout-2columns',
		'software-layout-3columns',
		'software-layout-4boxes',
		'software-layout-4columns',
		'software-layout-4lines',
		'software-layout-8boxes',
		'software-layout-header',
		'software-layout-header-2columns',
		'software-layout-header-3columns',
		'software-layout-header-4boxes',
		'software-layout-header-4columns',
		'software-layout-header-complex',
		'software-layout-header-complex2',
		'software-layout-header-complex3',
		'software-layout-header-complex4',
		'software-layout-header-sideleft',
		'software-layout-header-sideright',
		'software-layout-sidebar-left',
		'software-layout-sidebar-right',
		'software-magnete',
		'software-pages',
		'software-paintbrush',
		'software-paintbucket',
		'software-paintroller',
		'software-paragraph',
		'software-paragraph-align-left',
		'software-paragraph-align-right',
		'software-paragraph-center',
		'software-paragraph-justify-all',
		'software-paragraph-justify-center',
		'software-paragraph-justify-left',
		'software-paragraph-justify-right',
		'software-paragraph-space-after',
		'software-paragraph-space-before',
		'software-pathfinder-exclude',
		'software-pathfinder-intersect',
		'software-pathfinder-subtract',
		'software-pathfinder-unite',
		'software-pen',
		'software-pen-add',
		'software-pen-remove',
		'software-pencil',
		'software-polygonallasso',
		'software-reflect-horizontal',
		'software-reflect-vertical',
		'software-remove-vectorpoint',
		'software-scale-expand',
		'software-scale-reduce',
		'software-selection-oval',
		'software-selection-polygon',
		'software-selection-rectangle',
		'software-selection-roundedrectangle',
		'software-shape-oval',
		'software-shape-polygon',
		'software-shape-rectangle',
		'software-shape-roundedrectangle',
		'software-slice',
		'software-transform-bezier',
		'software-vector-box',
		'software-vector-composite',
		'software-vector-line',
		'software-vertical-align-bottom',
		'software-vertical-align-center',
		'software-vertical-align-top',
		'software-vertical-distribute-bottom',
		'software-vertical-distribute-center',
		'software-vertical-distribute-top',
		
		'weather-aquarius',
		'weather-aries',
		'weather-cancer',
		'weather-capricorn',
		'weather-cloud',
		'weather-cloud-drop',
		'weather-cloud-lightning',
		'weather-cloud-snowflake',
		'weather-downpour-fullmoon',
		'weather-downpour-halfmoon',
		'weather-downpour-sun',
		'weather-drop',
		'weather-first-quarter',
		'weather-fog',
		'weather-fog-fullmoon',
		'weather-fog-halfmoon',
		'weather-fog-sun',
		'weather-fullmoon',
		'weather-gemini',
		'weather-hail',
		'weather-hail-fullmoon',
		'weather-hail-halfmoon',
		'weather-hail-sun',
		'weather-last-quarter',
		'weather-leo',
		'weather-libra',
		'weather-lightning',
		'weather-mistyrain',
		'weather-mistyrain-fullmoon',
		'weather-mistyrain-halfmoon',
		'weather-mistyrain-sun',
		'weather-moon',
		'weather-moondown-full',
		'weather-moondown-half',
		'weather-moonset-full',
		'weather-moonset-half',
		'weather-move2',
		'weather-newmoon',
		'weather-pisces',
		'weather-rain',
		'weather-rain-fullmoon',
		'weather-rain-halfmoon',
		'weather-rain-sun',
		'weather-sagittarius',
		'weather-scorpio',
		'weather-snow',
		'weather-snow-fullmoon',
		'weather-snow-halfmoon',
		'weather-snow-sun',
		'weather-snowflake',
		'weather-star',
		'weather-storm-11',
		'weather-storm-32',
		'weather-storm-fullmoon',
		'weather-storm-halfmoon',
		'weather-storm-sun',
		'weather-sun',
		'weather-sundown',
		'weather-sunset',
		'weather-taurus',
		'weather-tempest',
		'weather-tempest-fullmoon',
		'weather-tempest-halfmoon',
		'weather-tempest-sun',
		'weather-variable-fullmoon',
		'weather-variable-halfmoon',
		'weather-variable-sun',
		'weather-virgo',
		'weather-waning-cresent',
		'weather-waning-gibbous',
		'weather-waxing-cresent',
		'weather-waxing-gibbous',
		'weather-wind',
		'weather-wind-e',
		'weather-wind-fullmoon',
		'weather-wind-halfmoon',
		'weather-wind-n',
		'weather-wind-ne',
		'weather-wind-nw',
		'weather-wind-s',
		'weather-wind-se',
		'weather-wind-sun',
		'weather-wind-sw',
		'weather-wind-w',
		'weather-windgust'
	);

	$output = '<input type="hidden" name="'.$param_name.'" class="wpb_vc_param_value '.$param_name.' '.$type.' '.$class.'" value="'.$value.'" id="trace"/>
				<div class="icon-preview"><i class="icon '.$value.'"></i><label>'.$value.'</label></div>';
	$output .='<input class="search" type="text" placeholder="Search Icon" />';
	$output .='<div id="icon-dropdown" >';
	$output .= '<ul class="icon-list">';
	$n = 1;
	foreach($icons as $icon)
	{
		$selected = ($icon == $value) ? 'class="selected"' : '';
		$id = 'icon-'.$n;
		$output .= '<li '.$selected.' data-ico="'.$icon.'"><i class="icon '.$icon.'"></i><label class="icon">'.$icon.'</label></li>';
		$n++;
	}
	$output .='</ul>';
	$output .='</div>';
	$output .='<div><strong>Icon References:</strong> ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/arrows/icons-reference.html" target="_blank">Arrows</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/basic/icons-reference.html" target="_blank">Basic</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/basic_elaboration/icons-reference.html" target="_blank">Basic Elaboration</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/ecommerce/icons-reference.html" target="_blank">Ecommerce</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/music/icons-reference.html" target="_blank">Music</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/software/icons-reference.html" target="_blank">Software</a>, ';
	$output .='<a href="'.get_template_directory_uri().'/fonts/linea-fonts/weather/icons-reference.html" target="_blank">Weather</a>';
	$output .='</div>';
	$output .= '<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery(".search").keyup(function(){
			 
					// Retrieve the input field text and reset the count to zero
					var filter = jQuery(this).val(), count = 0;
			 
					// Loop through the icon list
					jQuery(".icon-list li").each(function(){
			 
						// If the list item does not contain the text phrase fade it out
						if (jQuery(this).text().search(new RegExp(filter, "i")) < 0) {
							jQuery(this).fadeOut();
						} else {
							jQuery(this).show();
							count++;
						}
					});
				});
			});

			jQuery("#icon-dropdown li").click(function() {
				jQuery(this).attr("class","selected").siblings().removeAttr("class");
				var icon = jQuery(this).attr("data-ico");
				jQuery("#trace").val(icon);
				jQuery(".icon-preview").html("<i class=\'icon "+icon+"\'></i><label>"+icon+"</label>");
			});
	</script>';
	return $output;
}
add_shortcode_param('icon' , 'icon_field');

// [icon_box]
vc_map(array(
   "name"			=> "Icon Box",
   "category"		=> 'Content',
   "description"	=> "Place Icon Box",
   "base"			=> "icon_box",
   "class"			=> "",
   "icon"			=> "icon_box",

   
   "params" 	=> array(
		
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Title",
			"admin_label" 	=> false,
			"param_name" 	=> "title",
			"value" 		=> ""
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Separator",
			"param_name"	=> "separator",
			"value"			=> array(
				"With Separator"	=> "with_separator",
				"Without Separator"	=> "without_separator"
			),
			"std"			=> "with_separator",
		),
		
		array(
			"type" 			=> "icon",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Icon",
			"param_name" 	=> "icon",
			"admin_label" 	=> false,
			"value" 		=> "basic-info"
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Icon Position",
			"param_name"	=> "icon_position",
			"value"			=> array(
				"Top"		=> "top",
				"Left"		=> "left",
				"Right"		=> "right"
			),
			"std"			=> "top",
		),
		
		array(
			"type"			=> "dropdown",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Icon Style",
			"param_name"	=> "icon_style",
			"value"			=> array(
				"Normal"	=> "normal",
				"Outlined"	=> "outlined",
				"Background Color"	=> "bg_color"
			),
			"std"			=> "normal",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Icon Color",
			"param_name"	=> "icon_color",
			"value"			=> "#b39964",
		),
		
		array(
			"type"			=> "colorpicker",
			"holder"		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading"		=> "Icon Background Color",
			"param_name"	=> "icon_bg_color",
			"value"			=> "#ffffff",
			"dependency" 	=> Array('element' => "icon_style", 'value' => array('bg_color'))
		),
		
		array(
            "type" 			=> "textarea_html",
            "holder" 		=> "div",
            "class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
            "heading" 		=> "Description",
            "param_name" 	=> "content",
            "value" 		=> "",
         ),
		
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Link Text",
			"param_name" 	=> "link_name",
			"value" 		=> ""
		),
		
		array(
			"type" 			=> "textfield",
			"holder" 		=> "div",
			"class" 		=> "hide_in_vc_editor",
			"admin_label" 	=> true,
			"heading" 		=> "Link URL",
			"param_name" 	=> "link_url",
			"value" 		=> ""
		),
   )
   
));