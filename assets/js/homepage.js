$(document).ready(function(){
var slideIndex = 1;
showDivs(slideIndex);

	$("#prevSlide").click(function() {
		showDivs(slideIndex += -1);
	});

	$("#nextSlide").click(function() {
		showDivs(slideIndex += 1);
	});

	$("#slideDot1").click(function() {
		showDivs(slideIndex = 1);
	});
	$("#slideDot2").click(function() {
		showDivs(slideIndex =2);
	});
	$("#slideDot3").click(function() {
		showDivs(slideIndex =3);
	});
	
	(function () {
        var id = setInterval(frame,5000);

        function frame(){
            ++slideIndex
            showDivs(slideIndex);
        }
	})();

	
function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("homepageSlides");
    var dots = document.getElementsByClassName("slideDot");
    if (n > x.length) {
        slideIndex = 1
    }    
    if (n < 1) {
        slideIndex = x.length
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
      }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" slideActive", "");
    }
	
      x[slideIndex-1].style.display = 'block';
      dots[slideIndex-1].className += " slideActive";
	  
}
});
