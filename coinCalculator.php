<?php
include('classes/Coin.php');

$Coin = new Coin();

$Coin->setParams();

$totalProfit = $Coin->getTotalPrice()

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
        <meta name="description" content="coin calculator">
        <meta name="author" content="Matt McAlear">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Coin Calc</title>
    </head>
	<body>
        <h1>Coin Calculator</h1>
        <form method="post">
	        <table border="1">
	        	<tr>
	        		<th>Coin Quantity:</th>
	        		<td><input type="text" name="qty" id="qty" value="<?php echo $_POST['qty']; ?>" /></td>
	        	</tr>
	        	<tr>
	        		<th>Coin Type:</th>
	        		<td>
	        			<select name="type" id="type">
							<option value="doge">Doge</option>
	        			</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Mining Marketplace:</th>
	        		<td>
		        		<select name="miningMarketplace" id="miningMarketplace">
		        			<option value="dogehouse">Dogehouse</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Conversion Exchange:</th>
	        		<td>
		        		<select name="conversionExchange" id="conversionExchange">
		        			<option value="vircurex">Vicurex</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Cash Out Exchange:</th>
	        		<td>
		        		<select name="cashOutExchange" id="cashOutExchange">
		        			<option value="coinbase">Coinbase</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Rig Power Consumption:</th>
	        		<td><input type="text" name="powerCost" id="powerCost" value="<?php echo $_POST['powerCost']; ?>"/></td>
	        	</tr>
	        	<tr>
	        		<th>Apply Tax:</th>
	        		<td><input type="checkbox" name="tax" id="tax" <?php if($_POST['tax'] == 'on'){ echo 'checked'; } ?> /></td>
	        	</tr>
	        	<tr>
	        		<td></td>
	        		<td><input type="submit"></td>
	        	</tr>
	        	<tr>
	        		<th>TOTAL PROFIT:</th>
	        		<td><input type="text" name="profit" id="profit" value="<?php echo $totalProfit; ?>" /></td>
	        	</tr>
	        </table>
        </form>
    </body>
</html>