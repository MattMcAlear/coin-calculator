<?php

class Coin{
	private $qty = null;
	private $type = null;
	private $miningFee = null;
	private $conversionFee = null;
	private $cashOutFee = null;
	private $miningMarketplace = null;
	private $conversionExchange = null;
	private $cashOutExchange = null;
	private $bankFee = null;
	private $totalPowerCost = null;
	private $tax = .0575;
	private $total = 0;
	
	public function setParams(){
		$this->qty = $_POST['qty'];
		$this->type = $_POST['type'];
		$this->miningMarketplace = $_POST['miningMarketplace'];
		$this->conversionExchange = $_POST['conversionExchange'];
		$this->cashOutExchange = $_POST['cashOutExchange'];
		$this->bankFee = $_POST['bankFee'];
		$this->totalPowerCost = $_POST['powerCost'];
		$this->tax = ($_POST['tax'] == 'on' ? $this->tax : 0);
		
		//Set fees
		$this->conversionFee = $this->getConversionFee($this->conversionExchange);
		$this->cashOutFee = $this->getCashOutFee($this->cashOutExchange);
		$this->bankFee = $this->getBankFee($this->cashOutExchange);
	}
	
	public function getTotalPrice(){
		//in BTC
		$this->total = floatval($this->qty) * floatval($this->getDogeToBtcPrice($this->conversionExchange));
		//Apply fees
		$this->total = $this->total - ($this->total * $this->conversionFee);
		
		//in USD
		$this->total = $this->total * floatval($this->getBtcToUsdPrice($this->cashOutExchange));
		//Apply fees
		$this->total = $this->total - ($this->total * floatval($this->cashOutFee));
		$this->total = $this->total - floatval($this->bankFee);
		
		//Apply power cost
		$this->total = $this->total - floatval($this->totalPowerCost);
		
		//Apply tax
		$this->total = $this->total - ($this->total * $this->tax);
		
		return $this->total;
	}
	
	private function getConversionFee($exchange){
		switch($exchange){
			case 'vircurex':
				$params = '';
				$url 	= 'https://api.vircurex.com/api/get_trading_fee.json';
				$data 	= $this->curlApiCall($url, $params, 'json');
				return $data->fee;
				break;
		}
	}
	
	private function getCashOutFee($exchange){
		switch($exchange){
			case 'coinbase':
				$params = '';
				$url 	= 'https://coinbase.com/api/v1/prices/sell';
				$data 	= $this->curlApiCall($url, $params, 'json');
				return round($data->fees[0]->coinbase->amount / $data->subtotal->amount, 3);
				break;
		}
	}
	
	private function getBankFee($exchange){
		switch($exchange){
			case 'coinbase':
				$params = '';
				$url 	= 'https://coinbase.com/api/v1/prices/sell';
				$data 	= $this->curlApiCall($url, $params, 'json');
				return $data->fees[1]->bank->amount;
				break;
		}
	}
	
	private function getDogeToBtcPrice($exchange){
		switch($exchange){
			case 'vircurex':
				//DOGE to BTC
				$params = 'base=DOGE&alt=BTC';
				$url 	= "https://api.vircurex.com/api/get_highest_bid.json?";
				$data 	= $this->curlApiCall($url, $params, 'json');
				$btc = $data->value;
				break;
			case 'coincharts':
				//DOGE to BTC
				$params = "doge_btc";
				$url 	= "http://www.cryptocoincharts.info/v2/api/tradingPair/";
				$data 	= $this->curlApiCall($url, $params, 'json');
				$btc = $data->price;
				break;
			default:
				
				break;
		}	
		
		return $btc;
	}
	
	private function getBtcToUsdPrice($exchange){
		switch($exchange){
			case 'coinbase':
				//DOGE to BTC
				$params = '';
				$url 	= "https://coinbase.com/api/v1/prices/sell";
				$data 	= $this->curlApiCall($url, $params, 'json');
				$usd = $data->subtotal->amount;
				break;
		}	
		
		return $usd;
	}
	
	private function curlApiCall($url, $params, $decode = 'json'){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url.$params);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$rawData = curl_exec($curl);
		curl_close($curl);
		
		// decode to array
		switch($decode){
			case 'json':
				$data = json_decode($rawData);
				break;
			default:
				$data = json_decode($rawData);
				break;
		}
		
		return $data;
	}
}
?>