<html>
<head>
    <title>PHP Form Example</title>
</head>
<body>
	<?php echo $errorString; ?>
 	<form action="process.php" method="POST">
 		Name:*<br /><input type="text" name="name" value="<?php echo $name; ?>" /><br /><br />
 		Email:*<br /><input type="text" name="email" value="<?php echo $email; ?>" /><br /><br />
 		URL:*<br /><input type="text" name="url" value="<?php echo $url; ?>" /><br /><br />
 		<br /><br />
 		<input type="submit" name="submit" value="Submit Form" />
 	</form>
</body>
</html>