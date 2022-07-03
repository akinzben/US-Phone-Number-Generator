<?php
	include('config.php');
?>

<style>
	
	body{
		background:#000;
		color:#fff;
		font-family: monospace;
	}
	#resultbox{
		margin:20px auto;
		border:2px solid #00ff00;width:100%;height:300px;background:#000;color:#00ff00;
		padding:10px;
		font-size:10px;
	}
	#actionbtn{
		padding: 7px 12px;
		background: #8c0909;
		border: none;
		color: #fff;
	}
	#quantitybox{
		color: #fff;
		background: #000;
		border: 1px solid #00ff00;
		padding: 5px;
	}
	
</style>

<h3>Randomly Extract Phone Numbers From All United States</h3>

<form action="index.php" method="get">
	<input type="hidden" value="rand" name="req">
	<input type="number"  id="quantitybox" placeholder="How Many?" name="quantity"  value="500">
<button type="submit" id="actionbtn">Randomly Extract Phone Numbers</button></form>


<div style="overflow:hidden;">
<h3>Extract Phone Numbers From Specific State</h3>
<form action='index.php' method='get'>
	<input type='number' id="quantitybox" placeholder='How Many?' name='quantity' value="500"><br><br>
<?php
	
$fetchstates=mysqli_query($conn, "SELECT * FROM states");
while($getstates=mysqli_fetch_array($fetchstates)){
	$state_code=$getstates['state_code'];
	$state=$getstates['state'];
	
	echo "<div style='float:left;padding:5px 10px;border:1px solid #00ff00;'>
	
	<input type='radio' value='".$state_code."' name='req' id='".$state."'>
	<label style='cursor:pointer;' for='".$state."'>".$state."</label>";
	

echo "</div>";
}

?>
</div>
<br>
<button type="submit" id="actionbtn">Start Extraction</button>
<form>
<?php
	
	$req=$_GET['req'];
	$quantity=$_GET['quantity'];
	
	if($req=="rand"){
	
		echo '
		<br><br><div style="font-weight:600;font-size:17px;margin-top:10px;text-align:center;">'.$quantity.' Phone Numbers From Random States </div>
		<textarea id="resultbox">';
	
		$x=0;

		while($x<$quantity){
			$fetchareacodes=mysqli_query($conn, "SELECT * FROM areacodes ORDER by RAND()");

			$getareacodes=mysqli_fetch_array($fetchareacodes);
				$area_code=$getareacodes['area_code'];
				
				$numrand=rand(111,999);
				$numrand2=rand(1111,9999);

				echo "".$area_code."".$numrand."".$numrand2.", ";
				
			
			$x++;
		}
	}else{
		
		echo '
		<br><div style="font-weight:600;font-size:17px;margin-top:10px;text-align:center;">'.$quantity.' Phone Numbers From '.$req.' </div>
		<textarea id="resultbox">';
		
		$x=0;

		while($x<$quantity){
			
			$fetchareacodes=mysqli_query($conn, "SELECT * FROM areacodes WHERE Region='$req' ORDER by RAND()");

			$getareacodes=mysqli_fetch_array($fetchareacodes);
				$area_code=$getareacodes['area_code'];
				
				$numrand=rand(111,999);
				$numrand2=rand(1111,9999);

				$phonenumber="1".$area_code."".$numrand."".$numrand2."";

				
					echo "".$area_code."".$numrand."".$numrand2.", ";
				
			$x++;
			
			
		}
	}





?>

</textarea>

<!----

Made with love by BENJAMIN AKINDOTE

-->


