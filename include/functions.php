<?php

 function get_github_access_token($data){
	 $url= 'https://github.com/login/oauth/access_token';
	$ch=curl_init($url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($ch);
	preg_match('/access_token=([0-9a-f]+)/', $response, $out);
	curl_close($ch);
	return $out[0];
 }
 
 function get_user_info($access_token){
	$url= "https://github.com/api/v2/json/user/show?{$access_token}";
	$ch=curl_init($url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
	$response = curl_exec($ch);
	$user_data = json_decode($response,true);
	curl_close($ch);
	return $user_data['user'];
 }

 ?>
