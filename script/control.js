var shareButton = document.getElementById('share'),
	copyButton = document.getElementById('copy'),
	syntaxButton = document.getElementById('syntax');


syntaxButton.onclick = function() {
	var pre = $('#syntaxHolder')[0];
  	if(textarea.style.display != 'none') {
	  	pre.style.display = "block";
	  	textarea.style.display = "none";
	  } else {
	  	pre.style.display = "none";
	  	textarea.style.display ='block';
	  }

}

shareButton.onclick = function() {
  	
}

copyButton.onclick = function() {
  	var code = textarea.value;
  	
  	window.clipboardData.setData('Text', code);
  	console.log("Saved to Clipboard!");
}



		