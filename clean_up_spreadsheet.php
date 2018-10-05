<?php
		$cleaned_json = [];
		$jsonurl = "https://spreadsheets.google.com/feeds/list/" .  $_GET['id'] .  "/od6/public/values?alt=json";
		$tempjson = file_get_contents($jsonurl);
		$json =	preg_replace("/[\$]/", "x", $tempjson);
  		$json = json_decode($json,true);
		$json = $json["feed"]["entry"];

		foreach($json as $key=>$value){
    		 	$temp_obj = "";

			foreach($value as $key2=>$value2){
				   if (preg_match_all("/gsxx/",$key2)==1){
				   		$readable = explode("gsxx", $key2);
				 		$temp_obj-> $readable[1] = $value2[xt];
				   }
			}
			array_push($cleaned_json,$temp_obj);
		}
		echo json_encode($cleaned_json);
?>
