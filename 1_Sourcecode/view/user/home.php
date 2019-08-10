<!DOCTYPE>
<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
</head>
<body>
<h1>Đây là trang chủ</h1>
	<?php
   			if($dataMembers != NULL) 
   			{
    			foreach ($dataMembers as $value) 
    			{
	?>
					 <tr><?php echo $value['name']?></tr>
	<?php
				}
			}	
	?>

</body>
</html>