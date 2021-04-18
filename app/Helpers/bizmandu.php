<?php

function bzIndeces(){
	return  [
	'nepse','sensitive','float','senFloat','banking','devBank','hydropower','lifeInsurance','nonLifeInsurance','finance','others'
	]; 
}
function bzTopGainers(){
	$top_gainer_url = 'https://bizmandu.com/__stock/overview/topGainers';
	$gainers = @file_get_contents($top_gainer_url);
	return json_decode($gainers);
}

function bzTopLoosers(){
	$top_looser_url = 'https://bizmandu.com/__stock/overview/topLosers';
	$loosers = @file_get_contents($top_looser_url);
	return json_decode($loosers);
}

function bzMarketOverview($index=null,$period=null){
	$market_overview_url = 'https://bizmandu.com/__stock/overview/indicesData/';
	if(!$period){
		$period = '1d';
	}
	if(!$index){
		$index = 'nepse';
	}
	if(in_array($index,bzIndeces())){
		$market_overview_url = $market_overview_url.'?indicesName='.$index.'&period='.$period;
		$overview =  @file_get_contents($market_overview_url);
		return json_decode($overview);
	}
	return false;
}


function bzMarketOverviewSummary($index=null){
	$market_overview_url = 'https://bizmandu.com/__stock/overview/summary/';
	if(!$index){
		$index = 'nepse';
	}
	if(in_array($index,bzIndeces())){
		$market_overview_url = $market_overview_url.'?type='.$index;
		$overview =  @file_get_contents($market_overview_url);
		return json_decode($overview);
	}
	return false;
}