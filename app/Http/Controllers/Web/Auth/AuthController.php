<?php

namespace App\Http\Controllers\Web\Auth;

use App\Jobs\Otp_verify_job;
use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Services\AuthenticationService;

class AuthController extends Controller
{
    protected $authenticationService ; 

    public function __construct(AuthenticationService $authenticationService)
    {
        $this-> authenticationService = $authenticationService ; 
    }
    public function login(LoginRequest $loginRequest , AuthenticationService $authenticationService)
    {
        $data = $this->authenticationService->login($loginRequest) ; 
        if($data) 
        {
            return $this->apiResponse($data , 'User Logged in Successfully' , 200) ; 
        }
    }


    public function register(RegisterRequest $registerRequest )
    {
        $data = $registerRequest->validated() ; 
        $user = User::create($data) ; 
        $otp = Str::random(6);

     
        Otp::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expires_at' => Carbon::now()->addMinutes(5), 
        ]);

            dispatch(new Otp_verify_job($otp , $user)) ;
            $data['name'] = $registerRequest->name; 
            $data['email'] = $registerRequest->email ;
            $data['address'] = $registerRequest->address ; 
            $data['phone_numer'] = $registerRequest->phone_number;
            if(isset($registerRequest->image))
            {
                $imageName = Str::random(32) . "." . $registerRequest->image->getClientOriginalExtension() ;  
                $registerRequest->image->move(public_path('images') , $imageName) ;
            }
            $data['image'] = url('images/'.$imageName) ?? null ;  


        return $this->apiResponse($data , 'Registration successful. Please verify your OTP.' , 200) ;
    

    }
    public function verifyOtp(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'otp' => 'required|string',
    ]);

   
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return response()->json(['message' => 'User not found.'], 404);
    }

   
    $otpRecord = Otp::where('user_id', $user->id)
                    ->where('otp', $request->otp)
                    ->where('expires_at', '>', Carbon::now()) 
                    ->first();

    if (!$otpRecord) {
        return response()->json(['message' => 'Invalid or expired OTP.'], 400);
    }

  
    $user->email_verified = true;
    $user->save();

   
    $otpRecord->delete();

   
    $token = $user->createToken('ApiToken')->plainTextToken;

    return $this->apiResponse($token ,'OTP verified successfully. Your email has been verified.' , 200 );  
    

}

    public function logout (Request $request) 
    {
        $data  = $request->user()->currentAccessToken()->delete() ; 
        return $this->apiResponse('User Logged out Successfully' , 200)  ; 
    }
}


