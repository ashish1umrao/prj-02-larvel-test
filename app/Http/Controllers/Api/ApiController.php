<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\Info(title="API TICKETS", version="1.0")
 * basePath="/api",
 * tags={"Ver1"},
 * @OAS\SecurityScheme(
 *      securityScheme="bearer_token",
 *      type="http",
 *      scheme="bearer"
 * )
 */
class ApiController extends Controller
{
    protected $errorMessage;
    public function __construct(Request $request)
    {
        $this->startLog($request);
    }

    /* check validation */
    public function checkValidation($request, $params = [])
    {
        $validator = Validator::make($request->all(), $params);
        
        if ($validator->fails()) {
            $this->errorMessage = $validator->errors();
            return 0;
        } else {
            return 1;
        }
    }

    /* api response */
    public function response($status, $message = '', $result = [], $otherData = [])
    {
        $response['message'] = $message;

        if (!empty($result)) {
            $response['result'] = $result;
        }
        if (!empty($otherData)) {
            $response['otherData'] = $otherData;
        }
        $finalResponse =  response()->json($response, $status);
        $this->endLog($finalResponse);
        return $finalResponse;
    }

    /* Start Log */
    private function startLog($request)
    {
        if (env("API_LOG", false)) {
            $route = Route::getCurrentRoute()->getActionName();
            $date = Carbon::now();
            $route = Route::getCurrentRoute()->getActionName();

            Log::channel('api')->debug(
                sprintf(
                    "\n\n******* Start Log  ********\nPath: %s \n\nStart Time: %s \nParams: %s \nHeaders: %s \n",
                    $route,
                    $date->toDateTimeString(),
                    json_encode($request->all()),
                    json_encode($request->header())
                )
            );
        }
    }

    /* End Log */
    private function endLog($finalResponse)
    {
        if (env("API_LOG", false)) {
            $date = Carbon::now();
            Log::channel('api')->debug(
                sprintf(
                    "\n\Response: %s \nEnd Time: %s \n\n ***** End Log *****\n\r",
                    $finalResponse,
                    $date->toDateTimeString()
                )
            );
        }
    }
}
