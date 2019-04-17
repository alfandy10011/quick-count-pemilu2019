<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Traits\ImageTrait;
use Auth;
use App\Helpers\FaceDetector;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{   
    use ImageTrait;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

/*     public function username()
    {
        return \request('guard') == 'pt' ? 'email' : 'username';
    } */

    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'success' => true,
            'redirect' => url($this->redirectTo)
        ]);
    }

    public function attemptLogin(Request $request)
    {
      
        if ($request->has('data')){
            $data = explode(',',$request->get('data'));
            $email = $data[0];
            $password = $data[1];
            $creadential = [
                'email' => $email,
                'password' => $password
            ];
            $checking = User::where('email',$email)->first();

        } else {
            $creadential = [
                'email' => $request->email,
                'password' => $request->password
            ];
            $checking = User::where('email',$request->email)->first();
        }
        
        /* checking email */
        if ($checking){
            if(Auth::attempt($creadential)) {
                return response()->json([
                    'message' => true,
                    'redirect' => $this->redirectTo
                ],200);
            } else {
                return response()->json([
                    'message' => 'Your email or password wrong'
                ],404);
            }
        } else {
            return response()->json([
                'message' => 'your account not found'
            ],404);
        }
    }

    public function uploadImage(Request $request)
    {
        $data = User::where('id',1)->first();
        if($data){
            $image = $this->singleUpload($request,'photo','photo');
            /* $img = $request->imgBase64;
            $img = str_replace('data:image/png;base64,', '', $img);
            $img = str_replace(' ', '+', $img);
            $fileData = base64_decode($img);
            $fileName = 'photo.jpeg';
            file_put_contents($fileName, $fileData); */
            $detector = new FaceDetector;
            $detector->faceDetect($image);
            $data->update([
                'photo' => $image
            ]);
            return response()->json([
                'message' => $detector->toJson()
            ],200);
        }

        return response()->json(['message' => 'error'],500);

    }

    public function qrCodeLogin()
    {
        return view('auth.qr-login');
    }

    public function faceLogin()
    {
        return view('auth.face');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
