

<!DOCTYPE html>
 <html>
	<head>
		<title></title>
    </head>
	<body>
		<form  method="post" >
			<?php for($i=0; $i<10; $i++)
			{ 
			?>
				<input type="text" name="denda[]" /><Br>
			<?php
			}?>
			<input type="submit" name="submit" value="Submit" />
		</form>
	</body>
</html>

<?php

if (isset($_POST['denda']) && is_array($_POST['denda'])) {
	var_dump($_POST['denda']);
	echo "<Br><br>";
	for($i=0; $i<10; $i++){
		echo $_POST['denda'][$i];
	}

/*
array(4) {
	[0]=>
	string(5) "Hello"
	[1]=>
	string(5) "World"
	[2]=>
	string(3) "Foo"
	[3]=>
	string(3) "Bar"
}	
*/
}

?>