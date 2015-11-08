/*
 * The MIT License
 * 
 * Copyright (c) 2008-2009 Olle Törnström studiomediatech.com
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @author Olle Törnström olle[at]studiomediatech[dot]com
 * @since 2009-07-07
 * @version 1.0.0-ALPHA
 */
;(function($) {

	var settings = {};
	
	$.fn.Confirm = function (callback, parameters) {

		var finals = {};
		
		settings = $.extend({}, finals, $.fn.Confirm.defaults, parameters || {});
		
		$.fn.Confirm.init(callback);
		
		return this.each(function() {
			$(this).click(function(event) {
				event.preventDefault();
				$(this).Confirm.begin(callback, this, event);
			});
		});
	};

	$.fn.Confirm.defaults = {
		'title' : 'Title',
		'text' : 'Message',
		'ok' : 'Ok',
		'cancel' : 'Cancel',
		'okIcon' : '/images/icon_ok.png',
		'cancelIcon' : 'images/icon_cancel.png',
		'background-color' : '#eee',
		'addStyle' : true,
		'overlayId' : 'confirm-overlay',
		'confirmId' : 'confirm-container',
		'z-offset' : 100
	};
	
	$.fn.Confirm.init = function(callback) {
		
		try {
			$('#' + settings.overlayId).remove();
			$('#' + settings.confirmId).remove();			
		} catch (err) {}
		
		var overlayStyle = $.extend({
					'position' : 'absolute',
					'top' : 0,
					'right' : 0,
					'bottom' : 0,
					'left' : 0,
					'z-index' : settings['z-offset'] - 1
				}, 
				settings.addStyle ? {
					'background' : settings['background-color'],
					'opacity' : .5
				} : {});

		this.overlay = $('<div id="' + settings.overlayId + '"></div>')
				.click(function (ev) { ev.preventDefault(); })
				.css(overlayStyle).hide();
		
		var confirmStyle = $.extend({
					'position' : 'absolute',
					'z-index' : settings['z-offset']
				},
				settings.addStyle ? {
					'width' : '300px',
					'height' : '180px;',
					'background' : '#fff'
				} : {});
		
		this.confirm = $([
			'<div id="', settings.confirmId, '">',
			'<div class="title">',
			'<p>', settings.title, '</p>',
			'</div>',
			'<div class="text">',
			'<p>', settings.text, '</p>',
			'</div>',
			'<div class="buttons">',
			'<button class="ok"><span><img src="', settings.okIcon, '" alt="', settings.ok, '" /> ', settings.ok, '</span></button>',
			'<button class="cancel"><span><img src="', settings.cancelIcon, '" alt="', settings.cancel, '" /> ', settings.cancel, '</span></button>',
			'</div>',
			'</div>'
		].join('')).css(confirmStyle).hide();
		
		this.confirm.find('button.ok').click(function () { $.fn.Confirm.end(true); });
		this.confirm.find('button.cancel').click(function () { $.fn.Confirm.end(false); });
		
		$('body').append(this.overlay).append(this.confirm);
		
		$.fn.Confirm.adjust();
		
		$(window).resize(function() { $.fn.Confirm.resize(); });
		$(window).scroll(function(){ $.fn.Confirm.adjust(); });		
	};
	
	$.fn.Confirm.begin = function(callback, element, event) {
		
		this.callback = callback || function() {};
		this.element = element;
		this.event = event;
		
		this.overlay.show();
		this.confirm.show();
	};
	
	$.fn.Confirm.end = function (isConfirmed) {
		
		this.overlay.hide();
		this.confirm.hide();
		
		this.callback(isConfirmed, this.element, this.event);
	};
	
	$.fn.Confirm.resize = function () {
		
		this.overlay.width($(window).width()).height($(window).height());
		
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.confirm.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.confirm.outerWidth() / 2));
		
		this.confirm.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 300});
	};
	
	$.fn.Confirm.adjust = function () {
		
		this.overlay.top = $(window).scrollTop();
		this.overlay.left = $(window).scrollLeft();
		
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.confirm.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.confirm.outerWidth() / 2));
		
		this.overlay.animate({'top' : this.overlay.top + 'px', 'left' : this.overlay.left + 'px'}, {'queue' : false, 'duration' : 100});
		this.confirm.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 400});
	};	

})(jQuery);
