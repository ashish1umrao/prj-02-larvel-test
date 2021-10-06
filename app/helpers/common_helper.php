<?php

/*
 * check api header data
 */
if (!function_exists('getApiHeaderData')) { 
	function getApiHeaderData(){ 
		$headerData	=	apache_request_headers();  
        return $headerData;
	} 
}

/*
 * json outPut
 */
if (!function_exists('outPut')) {
	function outPut($status=0,$message='',$returnData=array()){
		$data					=	array();
		$result 				= 	array();
		if($status==0){
			$data['success'] 	= 	$status;
			$data['message'] 	= 	$message;
			$data['result'] 	=	(object) $result;
		}else{
			$data['success'] 	= 	$status;
			$data['message'] 	= 	$message;
			$data['result'] 	= 	$returnData;
		}
		header('Content-type: application/json');
		return json_encode($data);
	}
}

/*
 * json outPut
 */
if (!function_exists('logOutPut')) {
	function logOutPut($returnData=array()){
		header('Content-type: application/json');
		return json_encode($returnData);
	}
}


// Default Timezone
