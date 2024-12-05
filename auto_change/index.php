<?php include_once(dirname(dirname(__FILE__)) . '/parts/header.php'); ?>
<?php include_once(dirname(dirname(__FILE__)) . '/parts/sidebar.php'); ?>

<div class="wrapper">
    <input id="inputString" type="text" value="" onKeyUp="autoChange();" />
</div>

<script type="text/javascript">
function autoChange(){
    document.getElementById('inputString').value = document.getElementById('inputString').value.toUpperCase();
    while(document.getElementById('inputString').value.match(/[^A-Z ]/)){
        document.getElementById('inputString').value=document.getElementById('inputString').value.replace(/[^A-Z ]/,"");
    }
}
</script>

<?php include_once(dirname(dirname(__FILE__)) . '/parts/footer.php'); ?>

