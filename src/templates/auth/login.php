<?php
// echo getcwd();
include '../templates/partials/header.php';
include '../templates/partials/menu.php';
?>
<div class="container-fluid">
<div class="row">
<?php include '../templates/partials/sidenav.php'; ?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1>BEDREIV - Login </h1>

	<form action="/login" method="POST">
	<label for="username">Username:</label>
		<input type="text" id="username" name="username" placeholder="Username"><br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" placeholder="Password"><br>
		<input type="submit" name="login" id="login" value="Login">
	</form>

</div>
</div>
</div>

<?php
include '../templates/partials/footer.php';
?>