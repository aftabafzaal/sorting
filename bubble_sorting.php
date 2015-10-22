<?php
$error = "";
if (isset ( $_POST ['submit'] )) {
	
	$allowedExts = array ("txt" );
	$temp = explode ( ".", $_FILES ["userfile"] ["name"] );
	$extension = end ( $temp );
	
	if ($_FILES ["userfile"] ["error"] > 0) {
		$error .= "Error opening the file<br />";
	}
	if (! in_array ( $extension, $allowedExts )) {
		$error .= "Extension not allowed<br />";
	}
	if ($_FILES ["userfile"] ["size"] > 102400) {
		$error .= "File size shoud be less than 100 kB<br />";
	}
	
	if ($error == "") {
		$section = file_get_contents ( $_FILES ['userfile'] ['tmp_name'] );
		echo "Input File Content: " . $section;
		$unsortedArray = explode ( " ", $section );
		$sorted = bubbleSort($unsortedArray);
		echo "<br/>Output : " . implode ( " ", $sorted );
	} else {
		echo $error;
	}
}

function bubbleSort($array){
	$n=count($array);
	for ($i = 0;$i<$n;$i++)
	{
		for ($j=$n-1;$j>$i;$j--)
		{
			if ($array[$j] < $array[$j-1])
			{
				$temp=$array[$j-1];
				$array[$j-1]=$array[$j];
				$array[$j]=$temp;
			}
			
		}
	}
	return $array;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Quick Sorting</title>
</head>
<body>

	<form enctype="multipart/form-data" action="" method="POST">
		Send this file: <input name="userfile" type="file" /> <input
			type="submit" name="submit" value="Submit" />
	</form>

</body>
</html>