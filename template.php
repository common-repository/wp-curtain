<!DOCTYPE html>
<head>
	<?php $wpc_settings = wpc_get_settings(); ?>
	<title><?php echo $wpc_settings['page_title']; ?></title>
	<?php wp_head(); ?>
</head>
<body class="wp-curtain">
	<div id="container">
		<div id="content-section">
			<h1><?php echo $wpc_settings['page_heading']; ?></h1>
			<p><?php echo $wpc_settings['page_description']; ?></p>
		</div>
		<?php if(!$wpc_settings['disable_timer']) include('counter.php'); ?>
		<?php if(!$wpc_settings['disable_login_box'] && !is_user_logged_in()) include('login-box.php'); ?>
	</div>
</body>