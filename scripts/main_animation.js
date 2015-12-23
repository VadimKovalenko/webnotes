$(document).ready(function() {
	$('#note_left').animate({
		left: '+=25%', opacity: "1" // move 500px to the right
	}, 2000, function() {
	// Animation complete.
	});

	$('#note_center').animate({
		opacity: "1"// move 500px to the right
	}, 2000, function() {
	// Animation complete.
	});

	$('#note_right').animate({
		left: '-=25%', opacity: "1" // move 500px to the right
	}, 2000, function() {
	// Animation complete.
	});
});