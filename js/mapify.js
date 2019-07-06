// Slide obj: each Slideshow´s slide will contain the HTML element and the instance of TextFx.
                var Slide = function (el) {
                    this.el = el;
                    this.txt = new TextFx(this.el.querySelector('.title'));
                },
                        // The Slideshow obj.
                        Slideshow = function (el) {
                            this.el = el;
                            this.current = 0;
                            this.slides = [];
                            var self = this;
                            [].slice.call(this.el.querySelectorAll('.slide')).forEach(function (slide) {
                                self.slides.push(new Slide(slide));
                            });
                            this.slidesTotal = this.slides.length;
                            this.effect = this.el.getAttribute('data-effect');
                        };

                Slideshow.prototype._navigate = function (direction) {
                    if (this.isAnimating) {
                        return false;
                    }
                    this.isAnimating = true;

                    var self = this, currentSlide = this.slides[this.current];

                    this.current = direction === 'next' ? (this.current < this.slidesTotal - 1 ? this.current + 1 : 0) : (this.current = this.current > 0 ? this.current - 1 : this.slidesTotal - 1);
                    var nextSlide = this.slides[this.current];

                    var checkEndCnt = 0, checkEnd = function () {
                        ++checkEndCnt;
                        if (checkEndCnt === 2) {
                            currentSlide.el.classList.remove('slide--current');
                            nextSlide.el.classList.add('slide--current');
                            self.isAnimating = false;
                        }
                    };
                    

                    // Call the TextFx hide method and pass the effect string defined in the data-effect attribute of the Slideshow element.
                    currentSlide.txt.hide(this.effect, function () {
                        currentSlide.el.style.opacity = 0;
                        checkEnd();
                    });
                    // First hide the next slide´s TextFx text.
                    nextSlide.txt.hide();
                    nextSlide.el.style.opacity = 1;
                    // And now call the TextFx show method.
                    nextSlide.txt.show(this.effect, function () {
                        checkEnd();
                    });
                };

                Slideshow.prototype.next = function () {
                    this._navigate('next');
                };

                Slideshow.prototype.prev = function () {
                    this._navigate('prev');
                };

                
                var el=document.getElementsByClassName('slideshow');
                 [].slice.call(el).forEach(function (item) {
                    var slideshow = new Slideshow(item);
                    setInterval(function(){slideshow.next();},2000);
                });


// var theToggle = document.getElementById('toggle');
// based on Todd Motto functions
// http://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
	return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
    	elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
	var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
	if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
	var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0 ) {
            newClass = newClass.replace( " " + className + " " , " " );
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

//theToggle.onclick = function() {
 //  toggleClass(this, 'on');
 //  return false;
//};