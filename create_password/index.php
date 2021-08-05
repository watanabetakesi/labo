<html>
<body>
<?php
		$id = $_GET['id'];
		$pass = $_GET['pass'];

		if($id && $pass){

			$nonce = 'akiflfspo4fv09-34tvmlaspodkf2390m';

			//$createHash = mhash(MHASH_SHA256,$pass.$nonce);
			$hash = hash( 'sha256', $id.$nonce.$pass );

			echo "new password: \n";
			echo $hash . "\n";

		}else{
?>
<pre>
パラメータが不正です

?id=[ID]&pass=[パスワード]

を指定してください。
</pre>
<?php
		}

?>
</body>
</html>