var holder = document.getElementById('code'),
	authorField = document.getElementById('author'),
	key = holder.getAttribute('data-key'),
	pre = document.getElementById('syntaxHolder');

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

function download(key) {
	url = "/codesave/php/download.php";
	data = {};
	data['key'] = key;

	ajaxCall(url, data, function(response) {
		if(response.success) {
			holder.value = response.message.code;
			holder.readOnly = true;
			delayedResize();
			pre.text = response.message.code;
			authorField.innerHTML = response.message.author;
		} else {
			alert(" 404 Not Found!");
		}
	});
}

download(key);

