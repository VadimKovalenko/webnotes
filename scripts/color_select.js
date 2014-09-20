window.onload = colorSet();
window.onload = thumbTack_color();

function colorSet() {
var selectTag = document.getElementById("note_color");
var current_color = selectTag.value;
	//orange
	if (current_color == "#f8b39b") {
		selectTag.style.background = "#f8b39b";
	//red
	} else if (current_color == "#ed9d97") {
		selectTag.style.background = "#ed9d97";
	//yellow
	} else if (current_color == "#fbf6a7") {
		selectTag.style.background = "#fbf6a7";
	//green
	} else if (current_color == "#badbab") {
		selectTag.style.background = "#badbab";
	//blue
	} else if (current_color == "#a0c3ff") {
		selectTag.style.background = "#a0c3ff";
	//purple
	} else if (current_color == "#c5a5cf") {
		selectTag.style.background = "#c5a5cf";
	//pink	
	} else if (current_color == "#ffb6c1") {
		selectTag.style.background = "#ffb6c1";
	}
}

function thumbTack_color() {
	var thumb  = document.getElementsByClassName("thumbtack_wrapper");
	var note = document.getElementsByClassName("user_note");
	for (i=0; i < note.length; ++i) {
	if(note[i].style.background == "#f8b39b") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_7.png')";
	}else if(note[i].style.background == "#ed9d97") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_1.png')";
	}else if(note[i].style.background == "#fbf6a7") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_3.png')";
	}else if(note[i].style.background == "#badbab") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_2.png')";
	}else if(note[i].style.background == "#a0c3ff") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_6.png')";
	}else if(note[i].style.background == "#c5a5cf") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_4.png')";
	}else if(note[i].style.background == "#ffb6c1") {
		thumb[i].style.backgroundImage = "url('images/thumbtack_1.png')";	
		}	
	}
}