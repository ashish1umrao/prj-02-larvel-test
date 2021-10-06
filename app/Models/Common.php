<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Common extends Model
{
    use HasFactory;

    /***********************************************************************
	** Function name: getDataByQuery
	** Developed By: Ashish Umrao
	** Purpose: This function used for get data by query
	** Date : 09 JULY 2021
	************************************************************************/
	public function getData($action='',$tblname='',$groupBy='',$fieldName='',$fieldValue='',$resultType='')
	{  
        if($action      == "ALL"): 
            $result    = User::all();
        elseif($action  == "SINGLE"): 
            $result = User::find($groupBy);
        elseif($action  == "WHERE"): 
            $result    = User::where($fieldName, '=', $fieldValue)->first();
        endif;
		if($resultType == 'count'):	
			return $query->num_rows();
		elseif($resultType == 'single'):	
			if($query->num_rows() > 0):
				return $query->row_array();
			else:
				return false;
			endif;
		elseif($resultType == 'multiple'):	
			if($query->num_rows() > 0):
				return $query->result_array();
			else:
				return false;
			endif;
		else:
			return false;
		endif;
		
	}	// END OF FUNCTION
}
