<?php
		header("Access-Control-Allow-Origin: *");
    	header('Content-Type: application/json');

		$cleaned_json = [];
		$jsonurl = "https://spreadsheets.google.com/feeds/list/" .  $_GET['id'] .  "/od6/public/values?alt=json";
		$tempjson = file_get_contents($jsonurl);
		$json =	preg_replace("/[\$]/", "x", $tempjson);
  		$json = json_decode($json,true);
  		// echo json;
		$json = $json["feed"]["entry"];

		foreach($json as $key=>$value){
            $temp_obj= new stdClass();
            // echo "key " . $key . " value " . $value;
			foreach($value as $key2=>$value2){
				   if (preg_match_all("/gsxx/",$key2)==1){
				   		// echo "debugging " . $key2 .  " type of " .  gettype ( $key2) .   " is it numeric " .  is_numeric($key2);
				   		// echo " \nKey2 " . $key2 ;

				   		$readable = explode("gsxx", $key2);
				 		// echo  "\nReadable:   " . print_r($readable);
				   		// echo " \nReadable: " . $readable[1] . " Value 2: " . $value2["xt"];

				 		if (is_numeric($value2["xt"])) {
								$temp_obj->{$readable[1]} = (float)$value2["xt"];

				 		}else{
				 				$temp_obj->{$readable[1]} = $value2["xt"];

				 		}

				   }

			}
			//  echo  "\nTemp Object:   " . print_r($temp_obj) ;
			//var_dump($temp_obj);
			array_push($cleaned_json,$temp_obj);
		}
		echo json_encode($cleaned_json);
?>
