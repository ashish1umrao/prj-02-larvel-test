<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Http\Response;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'otp',
        'email_verify_status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /****************************************************************************************   
     * *** FUNCTION NAME    : register  
     * *** FUNCTION PURPOSE : This Function Used For register
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 1 OCT 2021
     ***************************************************************************************/
    // register user
    public function register($request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $result = [];
        try {
            if ($user->save()) {
                $result = [
                    'status' => Response::HTTP_OK,
                    'message' => 'User Register Successfuly.',
                ];
            } else {
                $result = [
                    'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message' => 'Somthing Wrong User Not Register!',
                ];
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $ex->getMessage(),
            ];
        }

        return $result;
    }
    /****************************************************************************************   
     * *** FUNCTION NAME    : getToken  
     * *** FUNCTION PURPOSE : This Function Used For Get Token
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 1 OCT 2021
     ***************************************************************************************/
    // get api token
    public function getToken($request)
    {
        $result = [];
        try {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('authToken');
            $token = $token->plainTextToken;
            if (!empty($token)) {
                $result = [
                    'status' => Response::HTTP_OK,
                    'message' => 'Login Suceessfuly.',
                    'headerToken' => $token,
                ];
            } else {
                $result = [
                    'status' => Response::HTTP_BAD_REQUEST,
                    'message' => 'Somthing Wrong User Not Login!',
                ];
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            $result = [
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $ex->getMessage(),
            ];
        }

        return $result;
    }
}
