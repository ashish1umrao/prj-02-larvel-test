<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\ApiController;
use Illuminate\Http\Response;
// LOAD DATABASE
use Illuminate\Support\Facades\DB;
// LOAD LANG FILE
use Illuminate\Support\Facades\lang;
class AuthController extends ApiControllercls
{       

    /****************************************************************************************
     * *** FUNCTION NAME    : Registration  
     * *** FUNCTION PURPOSE : This Function Used For Registration purpose
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 01 OCT 2021
     ***************************************************************************************/
    /**    
     * @OA\Post(
     ** path="/api/register",
     *   tags={"Ver1"},
     *   summary="Insert record in the users table",
     *   operationId="register",
     *
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Enter Name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Enter Password",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    public function register(Request $request)
    {
        $requiredFields = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        /* validation */
        if ($this->checkValidation($request, $requiredFields)) {
            /* Create New User */
            $user = new User();
            $result = $user->register($request);
            return $this->response($result['status'], $result['message']);
        } else {
            return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
        }
    }
     /****************************************************************************************
     * *** FUNCTION NAME    : Login  
     * *** FUNCTION PURPOSE : This Function Used For user login
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 01 OCT 2021
     ***************************************************************************************/
    /**
     * @OA\Post(
     ** path="/api/login",
     *   tags={"Ver1"},
     *   summary="Get user in users table ",
     *   operationId="login",
     *
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Enter Password",
     *         required=true,
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   )
     *)
     **/
    public function login(Request $request)
    {
        /* validation */
        $requiredFields = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        if ($this->checkValidation($request, $requiredFields)) {
            $cradential = request(['email','password']);
            // check user cradential
            if (!Auth::attempt($cradential)) {
                return $this->response(Response::HTTP_UNAUTHORIZED, 'Unauthorized Request!');
            }
            /* Get User auth-token */
            $user = new User();
            $result = $user->getToken($request);
            $headerToken = [
                'headerToken' => $result['headerToken']
            ];
            return $this->response($result['status'], $result['message'], $headerToken);
        }

        return $this->response(Response::HTTP_BAD_REQUEST, 'Bad Request!');
    }
    /****************************************************************************************   
     * *** FUNCTION NAME    : GetPostData  
     * *** FUNCTION PURPOSE : This Function Used For Get Post Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 05 OCT 2021
     ***************************************************************************************/
    /**
     * @OA\Post(
     ** path="/api/get-post-data",
     *   tags={"Ver1"},
     *   summary="Get Simple Text Data",
     *  security={{"bearer_token":{}}},
     *   operationId="getAlldata",
     *
     *     @OA\Parameter(
     *         name="headerToken",
     *         in="query",
     *         description="Enter Token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    
    
    public function GetPostData(Request $request)
    { 

        $requiredFields = [
            'email' => 'required|email'
        ];
         //$apiHeaderData 		        =	getApiHeaderData();
           if ($this->checkValidation($request, $requiredFields)) {
                return $this->response(Response::HTTP_OK, 'Hello World.');
            }
        return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
    }

    /****************************************************************************************   
     * *** FUNCTION NAME    : forgetPassword  
     * *** FUNCTION PURPOSE : This Function Used For send forget password code
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 1 OCT 2021
     ***************************************************************************************/
    /**
     * @OA\Post(
     ** path="/api/forgot-password",
     *   tags={"Ver1"},
     *   summary="User Forgot Password",
     *    security={{"bearer_token":{}}},
     *   operationId="forgetPassword",
     *
     *     @OA\Parameter(
     *         name="headerToken",
     *         in="query",
     *         description="Enter Token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    
    
    public function forgetPassword(Request $request)
    {  
      
        /* validation */
        $requiredFields = [
            'email' => 'required|email',
        ];
        if ($this->checkValidation($request, $requiredFields)) {
            $fogtEmail  = request(['email']);
            $user       = new User();
            $param      = '';
            // Update Result by id
            $user              =   User::where('email',$fogtEmail)  
            ->update([
                'otp'          =>   rand ( 1000 , 9999 ),
            ]);
            // End
            $userA               = User::where('email',$fogtEmail)->first() 
            ->get(); 
            //echo "<pre>";print_r($userA); die;
            $headerToken = [
                'UserInfo'    => $userA
            ];
            return $this->response(Response::HTTP_BAD_REQUEST, 'Send OTP on the registered mail Id', $headerToken);
        }

        return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
    }

    /****************************************************************************************   
     * *** FUNCTION NAME    : resetPassword  
     * *** FUNCTION PURPOSE : This Function Used For reset user password
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 1 OCT 2021
     ***************************************************************************************/
    /**
     * @OA\Post(
     ** path="/api/reset-password",
     *   tags={"Ver1"},
     *   summary="User Reset Password",
     *    security={{"bearer_token":{}}},
     *   operationId="resetPassword",
     *
     *     @OA\Parameter(
     *         name="headerToken",
     *         in="query",
     *         description="Enter Token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
        * @OA\Parameter(
        *         name="password",
        *         in="query",
        *         description="Enter Password",
        *         required=true,
        *         @OA\Schema(
        *             type="string",
        *         )
        *     ),
       * @OA\Parameter(
     *         name="otp",
     *         in="query",
     *         description="Enter OTP",
     *         required=true,
     *         @OA\Schema(
     *            type="string",
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    
    
    public function resetPassword(Request $request)
    {   
        /* validation */
        $requiredFields = [
            'email' => 'required|email',
            'otp'   => 'required',
            'password' => 'required',
        ];
        
        if ($this->checkValidation($request, $requiredFields)) {
            
            $Email          = trim($_REQUEST['email']);
            $otp            = trim($_REQUEST['otp']);
            $password       = bcrypt($request->password);
            //echo $Email; die;
            $user       = new User();
            $getUserByEmail = User::select('*')
            ->where([
                ['email', '=', $Email],
                ['otp','=',$otp]
            ])->first();
            //->get();
           //print_r($users);
           //END
            if($getUserByEmail <> ""){
                $getUserByEmail = DB::table('users')->where([
                    ['email', '=', $Email],
                    ['otp', '=', $otp],
                ])
                ->update([
                    'otp'                        =>   '',
                    'password'                   => $password,
                    'email_verified_at'          =>  date('Y-m-d H:i:s'),
                    ]);

                // GET ALL UPDATED DATA
                $UpdatedUserData               = User::where('email',$Email)->first() 
                ->get();
                $headerToken = [
                    'UserInfo'    => $UpdatedUserData
                ];
                return $this->response(Response::HTTP_OK, 'Password Successfully Reset', $headerToken);
            }elseif($getUserByEmail == ''){
                return $this->response(Response::HTTP_BAD_REQUEST, 'OTP Is Incorrect');
            }
        }
        return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
    }

    /****************************************************************************************   
     * *** FUNCTION NAME    : VerifyEmail  
     * *** FUNCTION PURPOSE : This Function Used For email verification
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 6 OCT 2021
     ***************************************************************************************/
    /**
     * @OA\Post(
     ** path="/api/VerifyEmail",
     *   tags={"Ver1"},
     *   summary="User Email Verification",
     *    security={{"bearer_token":{}}},
     *      operationId="VerifyEmail",
     *
     *     @OA\Parameter(
     *         name="headerToken",
     *         in="query",
     *         description="Enter Token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    
    
    public function VerifyEmail(Request $request)
    {   
        /* validation */
        $requiredFields = [
            'email' => 'required|email'
        ];
        
        $result 							= 	array();	
		$returnData 						= 	array();
        if ($this->checkValidation($request, $requiredFields)) {
            $VerifyEmail                = request(['email']);
            $emailVerification          = new User();
            // Get data By id
            $emailVerification          =   User::where('email',$VerifyEmail)->first();  
            //->get();
            //END
            if($emailVerification <>""): 
                $UpdatedUserData               = User::where('email',$VerifyEmail) 
                ->update([
                        'email_verified_at'          =>  date('Y-m-d H:i:s'),
                        'email_verify_status'        => 'Y',
                        ]);

                // GET ALL UPDATED DATA
                $UpdatedUserDataA               = User::where('email',$VerifyEmail)->first() 
                ->get();
                $headerToken = [
                    
                    'UserInfo'    => $UpdatedUserDataA
                ];
                echo outPut(1,"Your Email Successfuly Verified",$headerToken);
            elseif($emailVerification == ''):
                return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
            endif;
        }else {
            return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
        }
    }

    /* * *********************************************************************
	 * * Function name : checkEmailUnique
	 * * Developed By : Ashish Umrao
	 * * Purpose  : This function used for check email unique
	 * * Date : 06 OCTOBER 2021
	 * * **********************************************************************/
    /**
     * @OA\Post(
     ** path="/api/checkEmailUnique",
     *   tags={"Ver1"},
     *   summary="User check Email Uniqueness",
     *    security={{"bearer_token":{}}},
     *      operationId="checkEmailUnique",
     *
     *     @OA\Parameter(
     *         name="headerToken",
     *         in="query",
     *         description="Enter Token",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Enter Email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *)
     **/
    
    
    public function checkEmailUnique(Request $request)
	{	
        /* validation */
        $requiredFields = [
            'email' => 'required|email'
        ];
		$result 							= 	array();	
		$returnData 						= 	array();
		if ($this->checkValidation($request, $requiredFields)) {
			if($_REQUEST['email'] == ''):
				echo outPut(0,lang::get('api_lang.EMAIL_EMPTY'),$result);
			else: //echo "AAA"; die;
                $commonModel                    =   new Common();
				$whereCon				        =	$commonModel->where([['email', '=', trim($_REQUEST['email'])]]);
                $fieldName                      =   "email";
                $fieldValue                     =   $_REQUEST['email'];
				$userData						=	$commonModel->getData('WHERE','users','1',$fieldName,$fieldValue,'single');
                if($userData <> ""):  
					echo outPut(0,lang::get('api_lang.email_already_exists'),$result);
				else:
					echo outPut(1,lang::get('api_lang.email_available'),$result);
				endif;
			endif;
        }else {
            return $this->response(Response::HTTP_BAD_REQUEST, $this->errorMessage);
        }
	}


    /****************************************************************************************   
     * *** FUNCTION NAME    : logout  
     * *** FUNCTION PURPOSE : This Function Used For logout user
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 05 OCT 2021
     ***************************************************************************************/

    /**
     * @OA\Post(
     ** path="/api/logout",
     *   tags={"Ver1"},
     *   summary="user logout",
     *   security={{"bearer_token":{}}},
     *   operationId="logout",
     *
     *   @OA\Response(
     *      response=200,
     *       description="Success",
     *      @OA\MediaType(
     *           mediaType="application/json",
     *      )
     *   ),
     *   @OA\Response(
     *      response=401,
     *      description="Unauthenticated"
     *   ),
     *   @OA\Response(
     *      response=400,
     *      description="Bad Request"
     *   ),
     *   @OA\Response(
     *      response=404,
     *      description="not found"
     *   ),
     *   @OA\Response(
     *      response=403,
     *      description="Forbidden"
     *   ),
     *
     *)
     **/
    public function logout(Request $request)
    {
        /* delete auth token from personal_access_tokens table */
        $request->user()->currentAccessToken()->delete();
        return $this->response(Response::HTTP_OK, 'Logout Suceessfuly.');
    }
}
