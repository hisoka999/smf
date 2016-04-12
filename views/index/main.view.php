<html>

<body>
	Startseite
	
	<?php foreach($users as $user): ?>
		<div>
			<b>Username: </b><?=$user->username ?><br />
			<b>userid: </b><?=$user->userid ?><br />
			<a href="<?=UrlHelper::generate('index/user',[$user->userid]) ?>">Go To User</a>
			<pre><?php var_dump($user); ?></pre>
		</div>
	<?php endforeach;?>
</body>
</html>