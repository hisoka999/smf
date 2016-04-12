<html>

<body>
	User view
	
	
		<div>
			<b>Username: </b><?=$user->username ?><br />
			<b>userid: </b><?=$user->userid ?><br />
			<a href="<?=UrlHelper::generate('index/user',[$user->userid]) ?>">Go To User</a> <br />
			<a href="<?=UrlHelper::generate('index') ?>">Go To Index</a> <br />
		</div>
	
</body>
</html>