<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title> &bull; Instagram Developer Documentation</title>

<?php
if(isset($_GET['client_id']) && $_GET['redirect_uri'] && $_GET['response_type']){
$auth_url = 'https://api.instagram.com/oauth/authorize/?client_id=' . $_GET['client_id'] . '&redirect_uri=' . urlencode($_GET['redirect_uri']) . '&response_type=' . $_GET['response_type'];
?>
<script>
location.href = '<?= $auth_url ?>';

</script>

<?php
}
?>

    </head>
<body>

<form action="./" method="GET">
<p>Client ID: <input label="Client id" type="text" name="client_id" value="a1ac4880c0154d48ba5d691b288796a5" size="100" /></p>
<p>callback URL: <input label="Redirect URL" type="text" name="redirect_uri" value="<?= (isset($_GET['redirect_uri']) ? $_GET['redirect_uri'] : "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"); ?>" size="100" /></p>
<p><input type="submit" value="connect" /></p>
<input type="hidden" name="response_type" value="code" />
</form>

<textarea cols="100">
<?= var_dump($_GET) ?>
</textarea>
<br>
<textarea cols="100">
<?= var_dump($_POST); ?>
</textarea>

</body>
</html>



