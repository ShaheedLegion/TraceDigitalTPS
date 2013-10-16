
$(document).ready(function(){
  var currentPosition = 0;
  var slideHeight = 350;
  var delay = 3000;
  var slides = $('.slide');
  var numberOfSlides = slides.length;
  
  // Remove scrollbar
  $('#slidesContainer').css('overflow', 'hidden');
  
  // Wrap all .slides with #slideInner div
  slides.wrapAll('<div id="slideInner"></div>');

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('height', slideHeight * numberOfSlides);

  setInterval(showSlides, delay);
  
  function showSlides()
  {
	if (currentPosition < (numberOfSlides - 1))
		currentPosition++;
	else
		currentPosition = 0;

	$('#slideInner').delay(delay).animate({
        'marginTop' : slideHeight*(-currentPosition)
    }, "slow");
  }
  
$.fn.wait = function(time, type) {
		time = time || 1000;
		type = type || "fx";
		return this.queue(type, function() {
			var self = this;
			setTimeout(function() {
				$(self).dequeue();
			}, time);
		});
	};
  });
