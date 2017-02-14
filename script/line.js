var observe;
if (window.attachEvent) {
    observe = function (element, event, handler) {
        element.attachEvent('on'+event, handler);
    };
}
else {
    observe = function (element, event, handler) {
        element.addEventListener(event, handler, false);
    };
}

	var count = 1;
	var enterPressed = 0;
	var maxHeight = 510;

	addLine(count);

	textarea = document.getElementById('code');
	linesDiv = document.getElementsByClassName('line-number')[0];

	function handleKeys(evt) {
		evt = evt || window.event;

		if (evt.keyCode == 13) {
			enterPressed++;

			if (enterPressed >= count) {
				count++;
				addLine(count);
			}
		} else if(evt.keyCode==9 || evt.which==9){
            evt.preventDefault();

            var s = textarea.selectionStart;
            textarea.value = textarea.value.substring(0,textarea.selectionStart) + "\t" + textarea.value.substring(textarea.selectionEnd);
            textarea.selectionEnd = s+1; 
        }
        delayedResize();
	}
	

	function resize () {
		if (textarea.scrollHeight > maxHeight) {
			textarea.style.height = 'auto';
		    textarea.style.height = maxHeight+'px';


		    linesDiv.style.height = 'auto';
		    linesDiv.style.height = maxHeight+'px';
		} else {
		    textarea.style.height = 'auto';
		    textarea.style.height = textarea.scrollHeight+'px';


		    linesDiv.style.height = 'auto';
		    linesDiv.style.height = textarea.scrollHeight+'px';
		}

	    lines = getLines(textarea) - 1;
	    if (count > lines) {
	    	while(count > lines) {
		    	count--;
		    	removeLine();
		    }
	    } else if(count < lines) {
	    	while(count <= lines) {
		    	count++;
		    	addLine(count);
		    }
	    }

	    setScroll();
	}

	/* 0-timeout to get the already changed text */
	function delayedResize () {
	    window.setTimeout(resize, 0);
	}

	function setScroll() {
		linesDiv.scrollTop = textarea.scrollTop;
	}

	function setPaste() {
		delayedResize();
		textarea.value = textarea.value + "\n\n";
		linesDiv.scrollTop = textarea.scrollHeight;
		textarea.scrollTop = textarea.scrollHeight;
	}

	function setActiveLine() {
		pos = textarea.value.substr(0, textarea.selectionStart).split("\n").length;
		span = nthChild(linesDiv,pos);
		var active = document.getElementsByClassName('active-line');
		if(active)
			for(i = 0; i < active.length; i++) {
				active[i].className -= 'active-line';
			}
		span.className = 'active-line';
	}


	observe(textarea, 'change',  resize);
    observe(textarea, 'cut',     delayedResize);
    observe(textarea, 'paste',   delayedResize);
    observe(textarea, 'drop',    delayedResize);
    observe(textarea, 'keydown', handleKeys);
    observe(textarea, 'scroll',  setScroll);
    observe(textarea, 'mouseup', setActiveLine);
    observe(textarea, 'keyup',   setActiveLine);
    observe(textarea, 'paste',   setPaste);



	function addLine(count) {
		var num = document.getElementsByClassName('line-number')[0];
		span = document.createElement('span');
		span.innerHTML = count;
		var active = document.getElementsByClassName('active-line');
		if(active)
			for(i = 0; i < active.length; i++) {
				active[i].className -= 'active-line';
			}
		span.className = 'active-line';
		num.appendChild(span);
	}

	function removeLine() {
		var num = document.getElementsByClassName('line-number')[0];
		span = num.lastChild;
		if(span && span != num.firstChild) {
			num.removeChild(span);
			var active = num.lastChild;
			//active.className = 'active-line';
		}
	}

	function getLines(ta) {
		var taLineHeight = 30; // This should match the line-height in the CSS
		var taHeight = ta.scrollHeight; // Get the scroll height of the textarea
		var numberOfLines = Math.ceil(taHeight/taLineHeight);
		return numberOfLines;
	}

	function nthChild(ele, pos) {
		child = ele.firstChild;
		for (i = 1 ; i <= pos; i++)
			child = child.nextSibling;
		return child;
	}