<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>BEDREIV</title>
</head>
<body>
	<h1>BEDREIV - Login </h1>
	<pre><?php //print_r($data) ?></pre>

	<form action="/login" method="POST">
	<label for="username">Username:</label>
		<input type="text" id="username" name="username" placeholder="Username"><br><br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" placeholder="Password"><br>
		<input type="submit" name="login" id="login" value="Login">
	</form>

</body>
</html>