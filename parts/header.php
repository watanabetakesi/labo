<?php include_once(dirname(dirname(__FILE__)) . '/helpers/common_helper.php'); ?>
<html>
    <head>
        <link rel="stylesheet" href="<?= BASE_URL ?>/style.css" />
        <link rel="stylesheet" href="<?= BASE_URL ?>/lib/uikit/css/uikit.min.css" />
        <script src="<?= BASE_URL ?>/lib/uikit/js/uikit.min.js"></script>
        <script src="<?= BASE_URL ?>/lib/uikit/js/uikit-icons.min.js"></script>
    </head>
    <body>

    <nav class="uk-navbar-container">
    <div class="uk-container">
        <div uk-navbar>
            <div class="uk-navbar-left">
                <a class="uk-navbar-toggle uk-navbar-toggle-animate" uk-navbar-toggle-icon href="#"></a>
                <div class="uk-navbar-dropdown">
                    <ul class="uk-nav uk-navbar-dropdown-nav">
                        <li><a href="<?= BASE_URL ?>">TOP</a></li>
                        <?php 
                        $path = dirname(dirname( __FILE__));
                        $dirs = scandir($path);
                        
                        foreach($dirs as $dir){
                            
                            $class = (preg_match(pattern: "/{$dir}/", subject: $_SERVER["DOCUMENT_URI"])) ? ' class="uk-active"': "";

                            if(is_dir($path . "/" . $dir) &&
                            ($dir !== 'parts') &&
                            ($dir !== 'lib') &&
                            ($dir !== 'helpers') &&
                            ($dir !== '.') && 
                            ($dir !== '..' && 
                            ($dir !== '.git'))) echo '<li' . $class . '><a href="' . BASE_URL . "/{$dir}" .'">' . $dir . '</a></li>';
                        }
                        ?>                        
                    </ul>
                </div>
            </div>
            <div class="uk-navbar-center">
                <?= isset($page_title) ? $page_title : TITLE ; ?>
            </div>

        </div>
    </div>
    </nav>
