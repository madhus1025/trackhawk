<?php

	$orderid=$_GET['orderid'];

	$orders=$_GET['orders'];

	$index=0;

	$item="";
	
	$item_count=0;	
	
	explode($orders);

	while($index<strlen($orders)){
			
		$item="";
		$item_count=0;
		while($index<strlen($orders)&&$order[$index]!='('){	
			$index++;
		}	
		while($index<strlen($orders)&&$order[$index]!=' '){	
			$item=$item.$orders[$index];
			$index++;
		}	
		while($index<strlen($orders)&&$order[$index]!=')'){	
			$item_count=$item_count*10+$order[$index];
			$index++;
		}	
		echo $item;
	
		echo $item_count;
							
			
	}

	$result=$mysql_query($con,"select * from  ");	

?>
