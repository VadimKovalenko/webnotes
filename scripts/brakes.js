	function brakes() {
		var textarea = document.getElementById("note_text");
		var note_text =  document.getElementById("note_text").value;
		var send_msg = document.getElementById("attention_msg");		
		if ( note_text.match(/\n/g).length == 5) {
			send_msg.innerHTML = "Maximum 5 paragraphs";
			//textarea.disabled = "disabled";	
			textarea.setAttribute('maxlength', note_text.length);			
			} else {
			send_msg.innerHTML = "";
			textarea.setAttribute('maxlength', 50);	
			}
	}