<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<title><?php bloginfo('name'); ?> <?php wp_title('|', true, 'left'); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="SKYPE_TOOLBAR" CONTENT="SKYPE_TOOLBAR_PARSER_COMPATIBLE">

	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php wp_head(); ?>

</head>
<body>

	<header>
		<h1>Starter Vue Theme</h1>
	</header>