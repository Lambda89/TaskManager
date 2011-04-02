<?php require('System/sys.class.php'); ?>
<!DOCTYPE html>
<!-- HTML-standard not yet selected. -->

<?php 
/**
	Don't get mad but this is a generally not a good way. Where is the pre-processing
	of the request? sys is a dead class so there is none there? Where is the check
	for what browser etc being used?
	I think we need to redo this approach a little or we'll end up with a massive
	refactor down the road.
**/ 
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	
	<?php CssOutputUtility::outputCssLink(); ?>
	
	<?php JqueryOutputUtility::outputJqueryScripts(); ?>

	<title><?php FormatOutputUtility::outputHtmlTitle(); ?></title>
	
</head>

<body>
<div id="wrapper">
	<div id="header">
		<div id="main_menu">
			<a href="?menu" class="menu_nav"> Menu </a>
			<a href="?menu" class="menu_nav"> Menu </a>
		</div>
	</div>
	<div id="content">
		
	</div>
	<div id="footer">
		
	</div>
</div>

</body>
</html>
