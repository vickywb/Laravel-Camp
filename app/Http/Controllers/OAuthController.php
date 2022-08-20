<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Provider;
use App\Models\User;
use App\Repositories\UserRepository;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OAuthController extends Controller
{
    private $userRepository;

    public function __construct(
        UserRepository $userRepository    
    )
    {
        $this->userRepository = $userRepository;
    }

    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback(Request $request)
    {
        $socialProvider = Socialite::driver('google')->stateless()->user();
        $user = $this->userRepository->findByColumn($socialProvider->email, 'email');
        $userId = $socialProvider->getId();
        $avatar = Provider::where('avatar', $socialProvider->avatar)->first();
        $fileContents = file_get_contents($socialProvider->getAvatar());

        if (!$avatar) {
            $fileName = 'avatar' . '/' . $userId . time();
            $extension = 'jpg';
            //Define the path by wich we will store the new image
            $fullFileName = 'file' . '/' . 'google' . '/' . $fileName . '.' . $extension;
            
            Storage::put($fullFileName, (string)$fileContents, 'public');

            // The filename to save in the database.
            $uploadedFile = File::create([
                'location' => $fullFileName
            ]);

            $request->merge([
                'file_id' => $uploadedFile->id
            ]);
        }

        $data = [
            'name' => $socialProvider->name,
            'email' => $socialProvider->email,
            'email_verified_at' => date('Y-m-d H:i', time()),
        ];

        $dataFileId = $request->only([
            'file_id'
        ]);

        if (!$user) {
            $user = User::updateOrCreate($data);

            $user->userProfile()->create($dataFileId);

            $user->providers()->create([
                'provider_user_id' => $socialProvider->getId(),
                'provider_name' => Provider::GOOGLE_PROVIDER,
                'name' => $socialProvider->name,
                'email' => $socialProvider->email,
                'avatar' => $socialProvider->avatar,
                'email_verified_at' => date('Y-m-d H:i:s', time())
            ]);
        }

        Auth::login($user,true);

        return redirect()->route('user.dashboard');
    }

    public function facebookLogin()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback(Request $request)
    {   
        $socialProvider = Socialite::driver('facebook')->stateless()->user();
        $user = $this->userRepository->findByColumn($socialProvider->email, 'email');
        $userId = $socialProvider->getId();
        $avatar = Provider::where('avatar', $socialProvider->avatar)->first();
        $fileContents = file_get_contents($socialProvider->avatar_original . "&access_token={$socialProvider->token}");

        if (!$avatar) {
            $fileName = 'avatar' . '/' . $userId . time();
            $extension = 'jpg';
            //Define the path by wich we will store the new image
            $fullFileName = 'file' . '/' . 'facebook' . '/' . $fileName . '.' . $extension;
            
            Storage::put($fullFileName, (string)$fileContents, 'public');

            // The filename to save in the database.
            $uploadedFile = File::create([
                'location' => $fullFileName
            ]);

            $request->merge([
                'file_id' => $uploadedFile->id
            ]);
        }

        $data = [
            'name' => $socialProvider->name,
            'email' => $socialProvider->email,
            'email_verified_at' => date('Y-m-d H:i', time()),
        ];

        $dataFileId = $request->only([
            'file_id'
        ]);

        if (!$user) {
         $user = User::updateOrCreate($data);
         $user->userProfile()->create($dataFileId);
        
         $user->providers()->create([
            'user_id' => $data,
            'provider_user_id' => $socialProvider->getId(),
            'provider_name' => Provider::FACEBOOK_PROVIDER,
            'name' => $socialProvider->name,
            'email' => $socialProvider->email,
            'avatar' => $socialProvider->avatar,
            'email_verified_at' => date('Y-m-d H:i:s', time())
          ]);
        }

        Auth::login($user,true);

        return redirect()->route('user.dashboard');
    }
}
 