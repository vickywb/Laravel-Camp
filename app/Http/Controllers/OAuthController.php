<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use App\Processor\ProcessUploadFile;
use App\Repositories\FileRepository;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OAuthController extends Controller
{
    private $fileRepository;
    private $userRepository;

    public function __construct(
        FileRepository $fileRepository,
        UserRepository $userRepository    
    )
    {
        $this->fileRepository = $fileRepository;
        $this->userRepository = $userRepository;
    }

    public function login()
    {
        return view('auth.login');
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback(Request $request)
    {
        $callBack = Socialite::driver('google')->stateless()->user();
        // dd($callBack);
        $user = User::where('email', $callBack->email)->first();
        $avatar = $callBack->getAvatar();
        $userId = $callBack->getId();


        // $data = [
        //     'name' => $callBack->name,
        //     'email' => $callBack->email,
        //     'email_verified_at' => date('Y-m-d H:i', time()),
        // ];

        // $fileContents = file_get_contents($avatar);
        // dd($fileContents);
        if (!empty($avatar)) {
            $fileName = $userId . time() . '.jpg';
            $path = 'google/avatar';

            $fileStore = File::create([
                'location' => 'google/' . $fileName
            ]);

            dd($fileStore->id);
        }

        // if (!$user) {
        //     $userProvider = User::create($data);

        //     $userProvider->profile()->create()

        //     return 'create new user';
        // }

        // return 'email already taken';

        // $userId = $callBack->getId();
        // $avatar = $callBack->getAvatar();
        // // dd($callBack);
        // if ($avatar) {
        //     $fileName = "google/avatar/" . $userId .'/'. time() . ".jpg"; 
        //     // The filename to save in the database.
        //     dd($fileName);
        // }

        // if ($callBack->getAvatar()) {
        //     $fileName = "google/avatar/" . time() . ".jpg";

        //     dd($fileName());

        //     new ProcessUploadFile($fileName, [
        //         'field_name' => 'location',
        //         'extension' => $request->file($fileName)->getClientOriginalExtension(),
        //         'location' => 'user/'
        //     ], $request);

        //     // $uploadedFile = $this->fileRepository->store($request->only('location'));
        //     // $request->merge([
        //     //     'file_id' => $uploadedFile->id
        //     // ]);
        // }

        // $data = [
        //     'name' => $callBack->name,
        //     'email' => $callBack->email,
        //     'images' => $callBack->avatar,
        //     'email_verified_at' => date('Y-m-d H:i', time()),
        // ];
        // dd($data);

        // $user = User::firstOrCreate($data);

        // return $data;
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback(Request $request)
    {   
        $callBack = Socialite::driver('facebook')->stateless()->user();
        $userId = $callBack->getId();
        $avatar = $callBack->avatar . "&access_token={$callBack->token}";
        // dd($callBack->token);
        if ($avatar) {
            $fileName = 'facebook/avatar/' . $userId .'/' . time() . '.jpg'; 
            // The filename to save in the database.
            dd($fileName);
            // new ProcessUploadFile($fileName, [
            //     'field_name' => 'location',
            //     'extension' => $request->file($fileName)->getClientOriginalExtension(),
            //     'location' => 'user/'
            // ], $request);

            // $uploadedFile = $this->fileRepository->store($request->only('location'));
            // $request->merge([
            //     'file_id' => $uploadedFile->id
            // ]);
            // dd($fileName);
        }
        // dd($callBack->avatar);
        
        // if ($callBack->getAvatar()) {
        //     $fileName = "google/avatar/" . time() . ".jpg";

        //     dd($fileName());

        // }

        // $data = [
        //     'name' => $callBack->name,
        //     'email' => $callBack->email,
        //     'images' => $callBack->avatar,
        //     'email_verified_at' => date('Y-m-d H:i', time()),
        // ];

        // dd($data);
    }
}
 