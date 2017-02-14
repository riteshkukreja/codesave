<!DOCTYPE html>
<html>
<head>
	<title>CodeSave | Share Your Creations</title>
	<link rel="stylesheet" type="text/css" href="/codesave/style/codesave.css">
</head>
<body>
<header>
	<div class='logo'>
		<h1>CodeSave</h1>
		<span>Share Your Creations</span>
	</div>
	<div class='account'>
		<a href="#">Login</a>
	</div>
</header>
<div class="container">
	<div class='code-container'>
			<div class="code-form">
				<div class="line-number">
				</div>
				<textarea id='code'></textarea>
			</div>
	</div>
	<aside class='info'>
		<h3>Total Submissions: <b id='counter'>237489</b></h3>

		<div class='controls'>
			<a href="#" id='save' class="blue-button">Save</a>
			<a href="#" id='copy' class="blue-button">Copy</a>
			<a href="#" id='share' class="blue-button">Share</a>
			<a href="#" id='syntax' class="blue-button">Syntax</a>
		</div>
		<div class="details">
			<span>Author: </span>
			<input type='text' name='author' id='author' />
		</div>
	</aside>
</div>
<footer></footer>

<div id="alerts"></div>

	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src='/codesave/script/line.js'></script>
	<script type="text/javascript" src='/codesave/script/ajax.js'></script>
	<script type="text/javascript" src='/codesave/script/control.js'></script>
	
</body>
</html>
