<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>


<div class="wrapper">
<?
foreach($_SERVER as $key => $val){

    echo "<p> {$key} : {$val} </p>";

}
?>
</div>

<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>