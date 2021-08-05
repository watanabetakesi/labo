<html>
<body>
<p>つかいかた</p>
<p>1. Twitterの「リンクをコピー」からURLをコピー</p>
<img style="border: 1px solid #ccc;" src="howto.png" />
<p>2. フォームに入力して送信</p>
<form method="get" action="./">
<p>status URL</p>
<p><input type="text" size="120" name="status_url" value="<?= (isset($_GET['status_url'])) ? $_GET['status_url']:'https://twitter.com/kingkebab_tokyo/status/670031062106402816' ?>"></p>
<input type="submit" />
</form>
<blockquote class="twitter-tweet" lang="ja">
<a href="<?= (isset($_GET['status_url'])) ? $_GET['status_url']:'https://twitter.com/kingkebab_tokyo/status/670031062106402816'; ?>"></a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8">
</script>
</body>
</html>

