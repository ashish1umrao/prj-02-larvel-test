<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
/**
 * @SWG\Swagger(
 *     basePath="",
 *     schemes={"http", "https"},
 *     host=L5_SWAGGER_CONST_HOST,
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="L5 Swagger API",
 *         description="L5 Swagger API description",
 *         @SWG\Contact(
 *             email="ashish.u@e2logy.com"
 *         ),
 *     )
 * )
 */

// All Data rollout
    /****************************************************************************************
     * *** FUNCTION NAME    : Mail Controller  
     * *** FUNCTION PURPOSE : This Function Used For Registration purpose
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 07 OCT 2021
     ***************************************************************************************/
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // default controller
}
