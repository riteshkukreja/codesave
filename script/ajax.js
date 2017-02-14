var saveButton = document.getElementById('save'),

	textarea = document.getElementById('code'),
	authorInput = document.getElementById('author'),
	counter = document.getElementById('counter'),
	alerts = document.getElementById('alerts');


function ajaxCall(url, data, success) {
	$.ajax({
		type: 'POST',
		url: url,
		data: data,
		dataType: 'json',
		encode: true,

		success: success

	});
}

function addAlerts(type, message) {
	alerts.className = type;
	alerts.innerHTML = message;
	alerts.style.top = "0px";

	setTimeout(function() {
		alerts.style.top = "-100px";
	}, 5000);
}


function save(author, code) {
	if (author == "" || code == '') {
		addAlerts('failed', 'Please Enter Author Name and Code!');
		return;
	}
	url = "/codesave/php/save.php";
	data = {};
	data['code'] = code;
	data['author'] = author;

	ajaxCall(url, data, function(data) {
		if(data.success) {
			window.location = "/codesave/models/view.php?key=" + data.message;
		}else {
			addAlerts('failed', data.message);
		}
	});
}

function getTotalSubmissions(placeholder) {
	url = "/codesave/php/methods.php";
	data = {};
	data['submissions'] = true;

	ajaxCall(url, data, function(result) {
		placeholder.innerHTML = result;
	});
}



// Get Total submissions
getTotalSubmissions(counter);

saveButton.onclick = function() {
  	author = authorInput.value;
  	code = textarea.value;

  	save(author, code);
}

