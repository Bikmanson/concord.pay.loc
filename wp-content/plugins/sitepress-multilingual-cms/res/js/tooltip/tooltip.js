var WPMLCore = WPMLCore || {};

WPMLCore.Tooltip = function (element) {
	this.trigger = element;
	this.content = this.trigger.html(this.trigger.html()).text();
	this.edge = 'bottom';
	this.align = 'left';
	this.margin_left = '-54px';

	if (!this.content) {
		this.content = this.decodeEntities(this.trigger.data('content'));
	}

	if (this.trigger.data('edge')) {
		this.edge = this.trigger.data('edge');
	}

	if (this.trigger.data('align')) {
		this.align = this.trigger.data('align');
	}

	if (this.trigger.data('margin_left')) {
		this.margin_left = this.trigger.data('margin_left');
	}

	this.trigger.empty();
	this.trigger.click(jQuery.proxy(this.onTriggerClick, this));
};

WPMLCore.Tooltip.prototype = {
	open:           function () {
		if (this.trigger.length && this.content) {
			this.trigger.addClass('js-wpml-active-tooltip');
			this.trigger.pointer({
														 pointerClass: 'js-wpml-tooltip',
														 content:      this.content,
														 position:     {
															 edge:  this.edge,
															 align: this.align
														 },
														 show:         jQuery.proxy(this.onShow, this),
														 close:        this.onClose,
														 buttons:      this.buttons

													 }).pointer('open');
		}
	},
	onShow:         function (event, t) {
		t.pointer.css('marginLeft', this.margin_left);
	},
	onClose:        function (event, t) {
		t.pointer.css('marginLeft', '0');
	},
	onTriggerClick: function (e) {
		e.preventDefault();
		this.open();
	},
	buttons:        function (event, t) {
		var button = jQuery('<a class="close" href="#">&nbsp;</a>');

		return button.bind('click.pointer', function (e) {
			e.preventDefault();
			t.element.pointer('close');
		});
	},
	decodeEntities: function (encodedString) {
		var textArea = document.createElement('textarea');
		textArea.innerHTML = encodedString;
		return textArea.value;
	}
};

WPMLCore.initializeTooltips = function() {
	"use strict";

	var tooltips = jQuery('.js-wpml-tooltip-open'), tooltip = {};

	tooltips.each(function (index, element) {
		tooltip = new WPMLCore.Tooltip(jQuery(element));
	});

};

(function () {
	'use strict';

	jQuery(document).ready(function () {
		WPMLCore.initializeTooltips();
	});
}());