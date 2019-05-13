<?php

function getWebsites(){

	$json_website = file_get_contents('websites.json');
	$website = json_decode($json_website, true);

	return $website;
}

function getWebsite($websiteName){
	$websites = getWebsites();
	$result = array();
	foreach($websites as $website){
		if($website['website']==$websiteName){
			array_push($result, $website);
			return $result;
		}
	}
	return null;
}

function sendRequest($url){

	$ch = curl_init();

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);

	$output = curl_exec($ch);
	if($output === FALSE ){
		curl_close($ch);
		return null;
	}else{
		$jar = json_decode($output, true);
		curl_close($ch);
		return $jar;
	}
		
}

function sendGETRequest($url, $data = array()){

	$ch = curl_init();

	$url = $url.'?'.http_build_query($data);

	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);

	$output = curl_exec($ch);
	if($output === FALSE ){
		curl_close($ch);
		return null;
	}else{
		$jar = json_decode($output, true);
		curl_close($ch);
		return $jar;
	}
		
}

function sendPOSTRequest($url, $data = array()){

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_HEADER,0);

	$output = curl_exec($ch);

	if($output === FALSE ){
		curl_close($ch);
		return null;
	}else{
		$jar = json_decode($output, true);
		curl_close($ch);
		return $jar;
	}
		
}

function getApiUrl($websiteName, $apiName){
	$json_website = file_get_contents('websites.json');
	$websites = json_decode($json_website, true);

	foreach($websites as $website){
		if($website['website']==$websiteName){
			return $website['url'].$website['api'][$apiName];
		}
	}
	return null;
}

function getProductInfo($websiteName, $productID){
	$url = getApiUrl($websiteName, "product_info");

	$data = array("productID" => $productID);
	return insertAttribute(sendGETRequest($url, $data),"website",$websiteName);

}

function getProductRating($websiteName, $productID){
	$url = getApiUrl($websiteName, "product_rating");

	$data = array("productID" => $productID);
	return insertAttribute(sendGETRequest($url, $data),"website",$websiteName);

}

function getProductReview($websiteName, $productID){
	$url = getApiUrl($websiteName, "product_review");

	$data = array("productID" => $productID);
	return insertAttribute(sendGETRequest($url, $data),"website",$websiteName);

}

function getUserInfo($websiteName, $userID, $password){
	$url = getApiUrl($websiteName, "user_info");

	$data = array("userID" => $userID, "password" => $password);
	return insertAttribute(sendPOSTRequest($url, $data),"website",$websiteName);
}

function getProductVisit($websiteName){
	$url = getApiUrl($websiteName, "product_visit");

	return insertAttribute(sendRequest($url),"website",$websiteName);
}

function getProducts($websiteName){
	$url = getApiUrl($websiteName, "products");

	return insertAttribute(sendRequest($url),"website",$websiteName);
}

function getProductVisitArray(){
	$websites = getWebsites();
	$product_visit = array();
	foreach ($websites as $website){
		$product_visit = array_merge($product_visit, getProductVisit($website['website']));
	}

	foreach ($product_visit as $key => $row) {
	    $visit[$key]  = $row['Visit'];
	}

	array_multisort($visit, SORT_DESC, $product_visit);	

	return $product_visit;
}

function getProductVisitSorted($websiteName){
	$product_visit = getProductVisit($websiteName);

	foreach ($product_visit as $key => $row) {
	    $visit[$key]  = $row['Visit'];
	}

	array_multisort($visit, SORT_DESC, $product_visit);	
	return $product_visit;
}

function getProductVisitSortedChart($websiteName){
	$product_visit = getProductVisitSorted($websiteName);	

	$jarr = "[['Product', 'Visit']";

	foreach($product_visit as $value) {
		$jarr = $jarr.",['".$value['productName']."',".$value['Visit']."]";
	}

	$jarr = $jarr."]";

	return $jarr;
}

function getProductVisitChartArray(){
	$product_visit = getProductVisitArray();

	$jarr = "[['Product', 'Visit']";

	foreach($product_visit as $value) {
		$jarr = $jarr.",['".$value['productName']."',".$value['Visit']."]";
	}

	$jarr = $jarr."]";

	return $jarr;

}

function getRatingSummary($websiteName){
	$url = getApiUrl($websiteName, "rating_summary");

	return insertAttribute(sendRequest($url),"website",$websiteName);
}

function getRatingSummaryArray(){
	$websites = getWebsites();
	$rating_summary = array();
	foreach ($websites as $website){
		$rating_summary = array_merge($rating_summary, getRatingSummary($website['website']));
	}

	foreach ($rating_summary as $key => $row) {
	    $avg_rating[$key]  = $row['avg_rating'];
	}

	array_multisort($avg_rating, SORT_DESC, $rating_summary);
	return $rating_summary;
}

function getRatingSummarySorted($websiteName){

	$rating_summary = getRatingSummary($websiteName);

	foreach ($rating_summary as $key => $row) {
	    $avg_rating[$key]  = $row['avg_rating'];
	}

	array_multisort($avg_rating, SORT_DESC, $rating_summary);
	return $rating_summary;
}

function getRatingSummarySortedChart($websiteName){
	$rating_summary = getRatingSummarySorted($websiteName);

	$jarr = "[['Product', 'Avg Rating', { role: 'style' }, { role: 'annotation' }],
			 ['".$rating_summary[0]['productName']."', ".round($rating_summary[0]['avg_rating'],1).", '#4CAF50', '".$rating_summary[0]['productName']."'],            
			 ['".$rating_summary[1]['productName']."', ".round($rating_summary[1]['avg_rating'],1).", '#2196F3', '".$rating_summary[1]['productName']."'],            
			 ['".$rating_summary[2]['productName']."', ".round($rating_summary[2]['avg_rating'],1).", '#00bcd4', '".$rating_summary[2]['productName']."'],
			 ['".$rating_summary[3]['productName']."', ".round($rating_summary[3]['avg_rating'],1).", '#ff9800', '".$rating_summary[3]['productName']."'], 
			 ['".$rating_summary[4]['productName']."', ".round($rating_summary[4]['avg_rating'],1).", 'purple' , '".$rating_summary[4]['productName']."']]";

	return $jarr;

}

function getRatingSummaryChartArray(){
	$rating_summary = getRatingSummaryArray();

	$jarr = "[['Product', 'Avg Rating', { role: 'style' }, { role: 'annotation' }],
			 ['".$rating_summary[0]['productName']."', ".round($rating_summary[0]['avg_rating'],1).", '#4CAF50', '".$rating_summary[0]['productName']."'],            
			 ['".$rating_summary[1]['productName']."', ".round($rating_summary[1]['avg_rating'],1).", '#2196F3', '".$rating_summary[1]['productName']."'],            
			 ['".$rating_summary[2]['productName']."', ".round($rating_summary[2]['avg_rating'],1).", '#00bcd4', '".$rating_summary[2]['productName']."'],
			 ['".$rating_summary[3]['productName']."', ".round($rating_summary[3]['avg_rating'],1).", '#ff9800', '".$rating_summary[3]['productName']."'], 
			 ['".$rating_summary[4]['productName']."', ".round($rating_summary[4]['avg_rating'],1).", 'purple' , '".$rating_summary[4]['productName']."']]";

	return $jarr;

}

function insertAttribute($arr=array(), $key, $value){
	$result = array();
	if(!empty($arr)){
		$newarr = array($key => $value);
		foreach($arr as $line){
			array_push($result, array_merge($line, $newarr));
		}
	}
	return $result;
}

function addReview($websiteName,$review=array()){
	$url = getApiUrl($websiteName, "add_review");

	return sendPOSTRequest($url, $review);
}

function addAccessHistory($websiteName, $history=array()){
	$url = getApiUrl($websiteName, "add_access_history");

	return sendGETRequest($url, $history);
}

function addUser($websiteName, $user = array()){
	$url = getApiUrl($websiteName, "add_user");

	return sendPOSTRequest($url, $user);

}

?>