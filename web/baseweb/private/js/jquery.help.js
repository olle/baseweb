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
 * @since 2009-07-15
 * @version 1.0.0-ALPHA
 */
;(function($) {

	var settings = {};
	
	$.fn.Help = function (url, parameters) {
		
		var finals = {};
		
		settings = $.extend({}, finals, $.fn.Help.defaults, parameters || {});
		
		$.fn.Help.init();
				
		return this.each(function() {
			$(this).click(function(event) {
				event.preventDefault();
				$(this).Help.begin(url);
			});
		});
	};

	$.fn.Help.defaults = {
		'close' : 'Close',
		'closeIcon' : 'images/icon_cancel.png',
		'background-color' : '#eee',
		'addStyle' : true,
		'overlayId' : 'help-overlay',
		'helpId' : 'help-container',
		'z-offset' : 100
	};
	
	$.fn.Help.init = function(callback) {
		
		try {
			$('#' + settings.overlayId).remove();
			$('#' + settings.helpId).remove();			
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
		
		var helpStyle = $.extend({
					'position' : 'absolute',
					'z-index' : settings['z-offset']
				},
				settings.addStyle ? {
					'width' : '600px',
					'background' : '#fff'
				} : {});
		
		this.help = $([
			'<div id="', settings.helpId, '">',
			'<div class="text">',
			'</div>',
			'<div class="buttons">',
			'<button class="close"><span><img src="', settings.closeIcon, '" alt="', settings.close, '" /> ', settings.close, '</span></button>',
			'</div>',
			'</div>'
		].join('')).css(helpStyle).hide();
		
		this.help.find('button.close').click(function () { $.fn.Help.end(); });
		
		$('body').append(this.overlay).append(this.help);
		
		$.fn.Help.adjust();
		
		$(window).resize(function() { $.fn.Help.resize(); });
		$(window).scroll(function(){ $.fn.Help.adjust(); });		
	};
	
	$.fn.Help.begin = function(url) {
		var that = this;
		jQuery.get(url, function(data) {			
			that.help.find('.text').append(data);
			that.overlay.show();		
			that.help.show();
		});
	};
	
	$.fn.Help.end = function () {
				
		this.overlay.hide();
		this.help.hide();
		this.help.find('.text').empty();
	};
	
	$.fn.Help.resize = function () {
		
		this.overlay.width($(window).width()).height($(window).height());
		
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.help.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.help.outerWidth() / 2));
		
		this.help.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 300});
	};
	
	$.fn.Help.adjust = function () {
		
		this.overlay.top = $(window).scrollTop();
		this.overlay.left = $(window).scrollLeft();
		
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.help.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.help.outerWidth() / 2));
		
		this.overlay.animate({'top' : this.overlay.top + 'px', 'left' : this.overlay.left + 'px'}, {'queue' : false, 'duration' : 100});
		this.help.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 400});
	};	

})(jQuery);
