var Head = function($domElem) {
	this.$dom = $domElem;
	this.scrollPosition = null;
}


Object.defineProperty(Head.prototype, 'scrollPosition', {
	get: function() { return this.scrollPosition },
	set: function(_) {
		this.scrollPosition = this.$dom.scrollTop();
	}
});

Head.prototype.scrollToggle = function() {
	if (this.scrollPosition != 0) {
		this.$dom.addClass('scroll');
	} else {
		this.$dom.removeClass('scroll');
	}
}

Object.defineProperty(Head.prototype, 'position', {
	get: function() { return this.position },
	set: function(_) {
		if ( this.scrollPosition >= 0 ) {
			this.position = 'main';
		} else if ( this.scrollPosition > 98 && this.scrollPosition < 198 ) {
			this.position = 'about';
		} else if (this.scrollPosition > 198 && this.scrollPosition < 298 ) {
			this.position = 'faq';
		} else {
			this.position = 'footer';
		}
	}
})


Head.prototype.render = function() {
	this.$dom.data('position', this.position);
	$headerText.html(methods[this.position]);
	this.scrollToggle();
}

module.exports = Head;