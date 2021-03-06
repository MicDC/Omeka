<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php echo __('Omeka Admin'); ?>: <?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>

<?php
    queue_css_file(array('style', 'skeleton', 'jquery-ui'));
    queue_css_file('media/960min', 'only screen and (min-width: 960px)');
    queue_css_file('media/768min', 'only screen and (min-width: 768px) and (max-width: 959px)');
    queue_css_file('media/767max', 'only screen and (max-width: 767px)');
    queue_css_file('media/479max', 'only screen and (max-width: 479px)');
    queue_css_url('https://fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic|Cabin:400,700,400italic,700italic');

    queue_js_file(array('respond.min','globals','modernizr-min','selectivizr-min'));
?>

<!-- Plugin Stuff -->
<?php fire_plugin_hook('admin_theme_header', array('view'=>$this)); ?>

<!-- Stylesheets -->
<?php echo head_css(); ?>

<!-- JavaScripts -->
<?php echo head_js(); ?>

</head>

<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>

<header>

    <div class="container">
    
        <div id="site-title" class="two columns">
            <?php echo link_to_home_page(option('site_title'), array('target' => '_blank')); ?>
        </div>
    
        <nav>
            
            <?php echo common('global-nav'); ?>
            
            <ul id="user-nav">
            <?php if ($user = current_user()): ?>
                <?php
                    $name = html_escape($user->name);
                    if (is_allowed($user, 'edit')) {
                        $userLink = '<a href="' . html_escape(url('users/edit/' . $user->id)) . '">' . $name . '</a>';
                    } else {
                        $userLink = $name;
                    }
                ?>
                <li><?php echo __('Welcome, %s', $userLink); ?></li>
                <li><a href="<?php echo html_escape(url('users/logout'));?>" id="logout"><?php echo __('Log Out'); ?></a></li>
            <?php endif; ?>
            </ul>

        </nav>
    
    </div>
    
</header>

<section class="container container-twelve">

    <?php echo common('content-nav', array('title' => $title)); ?>

    <div class="subhead">
    
        <?php echo search_form(array('show_advanced' => true)); ?>
            
        <?php if (isset($title)) : ?>
            <?php 
                if(strlen($title) > 80) {
                    $title = substr($title,0,79) . '..."';
                } 
            ?>
            <h1 class="section-title"><?php echo $title ?></h1>
        <?php endif; ?>
    
    </div>
    
    <section class="container">
    
        <div id="content" class="ten columns offset-by-two omega">
