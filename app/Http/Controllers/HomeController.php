<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Helpers\FaceDetector;
use App\Traits\ImageTrait;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class HomeController extends Controller
{
    use ImageTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $data = User::find(Auth::user()->id);
        if ($data) {
            return view('dashboard',compact('data'));
        }

        abort(404);
    }

    public function api(Request $request)
    {
        $data = file_get_contents('https://pemilu2019.kpu.go.id/static/json/hhcw/ppwp.json');
        // $result = json_encode($data);
        $final  = json_decode($data,true);
        for($i=0; $i<count($final['chart']);$i++) {
            $prabowo = $final['chart']['22'];
            $jokowi = $final['chart']['21'];
            return response()->json([
                'jokowi' => $jokowi,
                'prabowo' => $prabowo
            ],200);
        }
    }

    public function proggress(Request $request)
    {
        $data = file_get_contents('https://pemilu2019.kpu.go.id/static/json/hhcw/ppwp.json');
        // $result = json_encode($data);
        $final  = json_decode($data,true);
        for($i=0; $i<count($final['progress']);$i++) {
            $total = $final['progress']['total'];
            $proses = $final['progress']['proses'];
    
            return response()->json([
                'total' => $total,
                'prosses' => $proses
            ],200);
        }
    }

    public function uploadImage(Request $request)
    {
        $data = User::where('id',3)->first();
        if($data){
            $image = $this->singleUpload($request,'photo','photo');
            $detector = new FaceDetector;
            $detector->faceDetect($request->file('photo'));
            $data->update([
                'photo' => $image
            ]);
           
            // return $detector->toJson();
            return response()->json([
                'message' => $detector->toJpeg()
            ],200);
        }

        return response()->json(['message' => 'error'],500);

    }

    public function runPython(Request $request)
    {
        $process = new Process(public_path('live2.py'));
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        echo $process->getOutput();
    }
}
