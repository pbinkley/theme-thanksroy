<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <?php if ( $description = settings('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>
    
    <title><?php echo settings('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php plugin_header(); ?>

    <!-- Stylesheets -->
    <?php
    queue_css('style');
    display_css(); 
    ?>
    <!-- JavaScripts -->
    <?php echo display_js(); ?>
    
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-1733464-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php plugin_body(); ?>
    	<div id="wrap">
    
    		<div id="header">
    		<?php plugin_page_header(); ?>
    		<div id="site-title"><?php echo link_to_home_page(custom_display_logo()); ?></div>
    		</div>
    		
    		<div id="content">
    		    <?php plugin_page_content(); ?>
    			<div id="primary-nav">
    				<div id="search-wrap">
    				    <h2>Search</h2>
    				    <?php echo simple_search(); ?>
    				    <?php echo link_to_advanced_search(); ?>
        			</div>
        			
        			<ul class="navigation">
        			    <?php echo custom_public_nav_header(); ?>
        			</ul>
    			</div>