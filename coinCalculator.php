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
        <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		
		<!-- Optional theme -->
		<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </head>
	<body style="background: none;">
        <h1>Coin Calculator</h1>
        <form method="post">
	        <table class="table-striped table-bordered table-hover">
	        	<tr>
	        		<th>Hash Rate <small><i>(KH/s)</i></small></th>
	        		<td><input type="text" class="form-control" name="khs" id="khs" value="<?php echo $_POST['khs']; ?>" placeholder="Not Available Yet" /></td>
	        	</tr>
	        	<tr>
	        		<td colspan="2" align="center">OR</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Quantity <small><i>(Per Day)</i></small></th>
	        		<td><input type="text" class="form-control" name="qty" id="qty" value="<?php echo $_POST['qty']; ?>" placeholder="1000" /></td>
	        	</tr>
	        	<tr>
	        		<th>Coin Type</th>
	        		<td>
	        			<select class="form-control" name="type" id="type">
							<option value="doge">Doge</option>
	        			</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Mining Marketplace</th>
	        		<td>
		        		<select class="form-control" name="miningMarketplace" id="miningMarketplace">
		        			<option value="dogehouse">Dogehouse</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Conversion Exchange</th>
	        		<td>
		        		<select class="form-control" name="conversionExchange" id="conversionExchange">
		        			<option value="vircurex">Vicurex</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Coin Cash Out Exchange</th>
	        		<td>
		        		<select class="form-control" name="cashOutExchange" id="cashOutExchange">
		        			<option value="coinbase">Coinbase</option>
		        		</select>
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Wattage</th>
	        		<td>
	        			<input type="text" class="form-control" onkeyup="calculateDailyPowerCost()" name="watt" id="watt" value="<?php echo $_POST['watt']; ?>" placeholder="500" />
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>$/kWh</th>
	        		<td>
	        			<input type="text" class="form-control" onkeyup="calculateDailyPowerCost()" name="dkwh" id="dkwh" value="<?php echo $_POST['dkwh']; ?>" placeholder="0.1" />
	        		</td>
	        	</tr>
	        	<tr>
	        		<th>Daily Power Cost</th>
	        		<td><input type="text" class="form-control" name="powerCost" id="powerCost" value="<?php echo $_POST['powerCost']; ?>" readonly  /></td>
	        	</tr>
	        	<tr>
	        		<th>Apply Tax</th>
	        		<td><input type="checkbox" class="form-control" name="tax" id="tax" <?php if($_POST['tax'] == 'on'){ echo 'checked'; } ?> /></td>
	        	</tr>
	        	<tr>
	        		<td></td>
	        		<td><input type="submit" class="btn btn-primary"></td>
	        	</tr>
	        	<tr>
	        		<th>TOTAL PROFIT <small><i>(Per Day)</i></small></th>
	        		<td><input type="text" name="profit" id="profit" value="<?php echo $totalProfit; ?>" /></td>
	        	</tr>
	        </table>
        </form>
        
        <script type="text/javascript">
        	function calculateDailyPowerCost(){
	        	var w = document.getElementById('watt').value;
	        	var dkwh = document.getElementById('dkwh').value;
	        	
	        	var total = w * 24 /*hours*/ / 1000 * dkwh;
	        	
	        	if(!isNaN(total)){
		        	document.getElementById('powerCost').value = Math.round(total * 100) / 100;
	        	}
        	}
        	
        	//Excecute
        	calculateDailyPowerCost();
        </script>
    </body>
</html>