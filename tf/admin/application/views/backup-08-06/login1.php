
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Admin | 1 Degree</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/bootstrap.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/jquery.fancybox.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>css/style.css">
</head>
<body class='login_body'>
	<div class="wrap"><br>
	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	&nbsp;	<img src="<?php echo WEB_DIR; ?>img/logo.png" width="200" />
		<form action="<?php echo WEB_URL; ?>login/admin_login"  autocomplete="off" method="post">
		<div class="login">
			<div class="email">
				<label for="user">Email</label><div class="email-input"><div class="input-prepend"><span class="add-on"><i class="icon-envelope"></i></span><input type="text" id="user" required name="email"></div></div>
			</div>
			<div class="pw">
				<label for="pw">Password</label><div class="pw-input"><div class="input-prepend"><span class="add-on"><i class="icon-lock"></i></span><input  required="required"  type="password" id="pw" name="password"></div></div>
			</div>
			<div class="remember">
				<label class="checkbox">
					<input type="checkbox"  value="1" name="remember"> Remember me on this computer
				</label>
			</div>
		</div>
		<div class="submit">
		<a>	<?php echo $status; ?></a>
			<button class="btn btn-red5">Login</button>
		</div>
		</form>
	</div>
<script src="<?php echo WEB_DIR; ?>js/jquery.js"></script>

</body>
</html>