<!doctype html>
<html>
	<head>
		<title>Test</title>
		<link rel="stylesheet" href="<?php echo URI; ?>/public/css/default.css" />
	</head>

	<body>

		<div id="header">
			Header<br/>

			<a href="<?php echo URI; ?>/index">Index</a>
			<a href="<?php echo URI; ?>/help">Help</a>
			<?php if (session::get('username')): ?>
				<a href="<?php echo URI; ?>/dashboard/logout">Logout</a>
			<?php else: ?>
				<a href="<?php echo URI; ?>/login">Login</a>
			<?php endif; ?>
		</div>

		<div id="content">
