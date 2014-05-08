<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://ww.w3.org/TR/xhtml1/DTD/XHTML1-TRANSITIONAL.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<title>
<?php bloginfo('name');?>
<?php wp_title();?>
</title>
<meta http-equiv="content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>" />
<meta name="generator" content="WordPress<?php bloginfo('version');?>" />
<!--leave this for s please -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="RSS2.0" href="<?php bloginfo('rss2_url');?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url')?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url') ;?>" />
<?php wp_get_archives('type=monthly&format=link');?>
<?php wp_head();?>
</head>
<body>
<div id="wrapper">
<!--header s -->
<div id="header">
<h1> <a href="<?php bloginfo('url')?>" >
  <?php bloginfo('name');?>
  </a> </h1>
  <?php bloginfo('description');?>
 </div>
<!--header e -->