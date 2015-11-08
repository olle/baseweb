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
 *
 * @author  Olle Törnström olle[at]studiomediatech[dot]com
 * @since   2009-09-27
 * 
 * @depends jquery.filebrowser.js
 */
(function ($) {
	var settings = {};
	$.fn.filepicker = function (fn, options) {
		settings = $.extend({}, {
				'handler' : 'php/jquery.filepicker.php',
				'overlayId' : 'filepicker-overlay',
				'pickerId' : 'filepicker',
				'z-offset' : 100,
				'dir' : '/tmp/',				
				'inputLabel' : 'Type a file URL here or pick one below...',
				'width' : 400,
				'height' : 340
		}, options || {});
		var callback = fn || function () {};
		$.fn.filepicker.init();
		return $(this).each(function () {
			$(this).click(function () {
				$.fn.filepicker.show(this, callback);
			});
		});
	};
	$.fn.filepicker.init = function () {
		try {
			$('#' + settings.overlayId).remove();
			$('#' + settings.pickerId).remove();			
		} catch (err) {}
		this.overlay = $('<div id="' + settings.overlayId + '"></div>')
				.click(function (ev) { ev.preventDefault(); })
				.css({
						'position' : 'absolute',
						'top' : 0,
						'right' : 0,
						'bottom' : 0,
						'left' : 0,
						'z-index' : settings['z-offset'] - 1,
						'background-color' : '#000',
						'opacity' : .5,
						'width' : '100%'				
				}).hide();
		this.picker = $([
				'<div id="' + settings.pickerId + '">',
					'<div class="picker-header">',
						'<input type="text" id="picker-url" value="' + settings.inputLabel + '" />',
					'</div>',
					'<div class="picker-body"></div>',
					'<div class="picker-footer">',
					'</div>',
				'</div>'
						].join(''))
				.css({
						'position' : 'absolute',
						'z-index' : settings['z-offset'],
						'width' : settings.width,
						'height' : settings.height,
						'background-color' : '#fff',
				})
				.hide();
		$('body').append(this.overlay).append(this.picker);
		$.fn.filepicker.adjust();
		$(window).resize(function () { $.fn.filepicker.resize(); });
		$(window).scroll(function() { $.fn.filepicker.adjust(); });				
	};
	$.fn.filepicker.show = function (el, callback) {
		var that = this;
		$(this.picker)
				.find('#picker-url')
				.focus(function () { $.fn.filepicker.manual(this, el, callback); })
				.blur(function () { $(this).attr('value', settings.inputLabel); });
		$(this.picker.find('.picker-body').empty().get(0)).filebrowser({'dir' : settings.dir, 'handler' : settings.handler}, function (elem) {
			$.fn.filepicker.pick(elem, el, callback);
		});
		this.overlay.show();
		this.picker.show();
	};
	$.fn.filepicker.pick = function (elem, el, callback) {
		var $$ = $(elem);
		if ($(elem).hasClass('file')) {
			var file = $$.attr('rel');
			this.picker.hide();
			this.overlay.hide();
			if ($(el).attr('type') === 'text')
				$(el).attr('value', file);
			callback(file);
		}
	};
	$.fn.filepicker.manual = function (elem, el, callback) {
		var $$ = $(elem);
		if ($$.attr('value') === settings.inputLabel)
			$$.attr('value', 'http://');
		var that = this;
		$$.keypress(function (ev) {
			if (ev.keyCode === 13) {
				var url = $$.attr('value');
				that.picker.hide();
				that.overlay.hide();
				if ($(el).attr('type') === 'text')
					$(el).attr('value', url);
				callback(url);
			}
		});	
	};
	$.fn.filepicker.resize = function () {
		this.overlay.width($(window).width()).height($(window).height());
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.picker.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.picker.outerWidth() / 2));
		this.picker.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 200});
	};
	$.fn.filepicker.adjust = function () {
		this.overlay.top = $(window).scrollTop();
		this.overlay.left = $(window).scrollLeft();
		var top = Math.round(this.overlay.top + ($(window).height() / 2) - (this.picker.outerHeight() / 2));
		var left = Math.round(this.overlay.left + ($(window).width() / 2) - (this.picker.outerWidth() / 2));
		this.overlay.animate({'top' : this.overlay.top + 'px', 'left' : this.overlay.left + 'px'}, {'queue' : false, 'duration' : 100});
		this.picker.animate({'left' : left + 'px', 'top' : top + 'px'}, {'queue' : false, 'duration' : 200});
	};	
})(jQuery);