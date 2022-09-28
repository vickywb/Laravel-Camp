<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadProfileRequest;
use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use App\Models\UserProfile;
use App\Processor\ProcessUploadFile;
use App\Repositories\FileRepository;
use App\Repositories\UserProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{   
    private $userRepository;
    private $userProfileRepository;
    private $fileRepository;

    public function __construct(
        UserRepository $userRepository,
        UserProfileRepository $userProfileRepository,
        FileRepository $fileRepository
    )
    {
        $this->userRepository = $userRepository;
        $this->userProfileRepository = $userProfileRepository;
        $this->fileRepository = $fileRepository;
    }

    public function login()
    {
        return view('auth.user.login');
    }

    public function userLogin(Request $request)
    {
        $user = $this->userRepository->findByColumn($request->email, 'email');
        
        if ($user->role != 2) {
            return redirect()->back()->withErrors([
                'message' => 'This is User Area.'
            ]);
        }

        if (!$user) {
            return redirect()->back()->withErrors([
                'message' => 'Username and Password did not match.'
            ]);
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->withErrors([
                'message' => 'Username and Password did not match.'
            ]);
        }

        Auth::login($user, true);

        return redirect()->route('user.dashboard');
    }

    public function userRegister(Request $request)
    {   
        $user = new User();

        return view('auth.user.register', [
            'user' => $user
        ]);
    }

    public function userStoreData(UserRegisterRequest $request, User $user)
    {   
        $request->merge([
            'role' => User::ROLE_MEMBER,
            'email_verified_at' => date('Y-m-d H:i', time())
        ]);

        $data = $request->only([
            'name', 'email', 'password', 'role', 'email_verified_at'
        ]);

        try {
            DB::beginTransaction();

            $user = new User($data);
            $user = $this->userRepository->store($user);

            $request->merge([
                'user_id' => $user->id
            ]);  

            $data = $request->only([
                'user_id', 'file_id', 'address', 'phone_number'
            ]);
            
            $userProfile = new UserProfile($data);
            $this->userProfileRepository->store($userProfile); 

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('user.dashboard');
    }

    public function userChangeProfile(Request $request)
    {
        $user = auth()->user();

        return view('user.profile', [
            'user' => $user
       ]);
    }
    
    public function uploadProfile(UploadProfileRequest $request, User $user)
    {   
        if ($request->hasFile('image')) {
            $file = $request->file('image')->get();

            new ProcessUploadFile($file, [
                'field_name' => 'location',
                'extension' => $request->file('image')->getClientOriginalExtension(),
                'location' => 'profile/'
            ], $request);

            $uploadedFile = $this->fileRepository->store($request->only('location'));

            $request->merge([
                'file_id' => $uploadedFile->id
            ]);

            if ($user->userProfile->file_id) {
                $oldFileName = $user->userProfile->file->location;
            }

            if (isset($oldFileName)) {
                Storage::delete($oldFileName);
            }
    
        } else {
            $request->merge([
                'file_id' => $user->userProfile->file_id
            ]);
        }
  
        $data = $request->only([
            'name', 'occupation', 'file_id', 'image', 'address', 'phone_number'
        ]);

        try {
            DB::beginTransaction();

            $user = $user->fill($data);
            $user = $this->userRepository->store($user);

            $user->userProfile()->update([
                'file_id' => $data['file_id'],
                'address' => $data['address'],
                'phone_number' => $data['phone_number'] 
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('user.dashboard')->with([
            'success' => 'Your Profile has been updated.'
        ]);
    }

    public function userChangePassword()
    {
        return view('auth.user.change-password');
    }

    public function storePassword(UserChangePasswordRequest $request)
    {   
        $user = auth()->user();

        $data = $request->only([
            'password'
        ]);

        try {
            DB::beginTransaction();

            $user = $user->fill($data);
            $user = $this->userRepository->store($user);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect()->back()->withErrors([
                'errors' => $th->getMessage()
            ]);
        }

        return redirect()->route('user.dashboard')->with([
            'success' => 'Your Password has been updated.'
        ]);
    }
}
