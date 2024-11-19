<?php
if(isset($_GET['run'])){
	//API link
	$apiLink = "https://api.spacexdata.com/v4/launches";
	//curl session
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => $apiLink,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
	]);
	//Added this bit to sort an error I was getting
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
	//Run the API request
	$response = curl_exec($curl);
	$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	//Decode response
	$launches = json_decode($response, true);
	
	//LAUNCHES PER YEAR
	if($_GET['run'] == 'year'){
		$launches_per_year = [];
		foreach ($launches as $launch) {
			//Get the year from the response JSON - original format like "2006-03-24T22:30:00.000Z"
			$year = substr($launch['date_utc'], 0, 4);
			if (!isset($launches_per_year[$year])) {
				$launches_per_year[$year] = 1;
			}else{
				$launches_per_year[$year]++;
			}
		}
	}
	
	//LAUNCES PER SITE
	if($_GET['run'] == 'site'){
		$launches_per_site = [];
		$sites_name = [];
		$sites_images = [];
		foreach ($launches as $launch) {
			//Get the responses we need - site id, site name and site image
			$site_id = $launch['launchpad'];
			$site_name = $launch['name'];
			$site_image = $launch['links']['patch']['small'];
			if (!isset($launches_per_site[$site_id])) {
				$launches_per_site[$site_id] = 1;
				$sites_name[$site_id] = $site_name;
				$sites_images[$site_id] = $site_image;
			}else{
				$launches_per_site[$site_id]++;
			}
		}
	}
	
}
?>