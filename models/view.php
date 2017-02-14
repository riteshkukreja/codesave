<!DOCTYPE html>
<html>
<head>
	<title>CodeSave | Share Your Creations</title>
	<link rel="stylesheet" type="text/css" href="/codesave/style/codesave.css">
	<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js?autoload=true&amp;skin=sunburst&amp;lang=css" defer="defer"></script>
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
				
				<textarea id='code' data-key='<?= $_GET["key"] ?>'></textarea>
				<pre class="prettyprint" id='syntaxHolder'></pre>
			</div>
	</div>
	<aside class='info'>
		<div class='controls'>
			<a href="#" id='copy' class="blue-button">Copy</a>
			<a href="#" id='share' class="blue-button">Share</a>
			<a href="#" id='syntax' class="blue-button">Syntax</a>
		</div>

		<div class='details'>
			<div id='author'></div>
		</div>
	</aside>
</div>
<footer></footer>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src='/codesave/script/line.js'></script>
	<script type="text/javascript" src='/codesave/script/download.js'></script>
	<script type="text/javascript" src='/codesave/script/control.js'></script>
	
</body>
</html>