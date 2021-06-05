<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(20);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'max:255|required',
            'email' => 'email|unique:users|max:255|required',
            'honorific' => 'required',
            'type' => 'required'
        ]);

        $user = new User($data);
        $user->password = Hash::make($data['email']);

        $user->save();

        return redirect("/users/");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => '',
            'honorific' => 'required',
            'type' => 'required'
        ]);

        $user->status = 'active';

        return redirect("/home");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect("/users/")->with('Success', 'User deleted !');
    }

    public function settings(Request $request, User $user)
    {
        $data = request()->validate([
            'name' => 'required',
            'honorific' => 'required',
            'avatar' => 'image',
        ]);
        $user = auth()->user();


        if (request('avatar')) {
            $imagePath = $user->avatar;

            /*
            dd([Storage::exists($imagePath), $imagePath ]);
            if (Storage::exists($imagePath) && $user->avatar != '/storage/profile/MtpyrBaoXds78Rs13ZwOaSSkPFo5cl4IC7dHH3U8.jpeg') {
            Storage::delete($imagePath);

        }*/

            $imagePath = "/storage/" . request('avatar')->store('profile', 'public');
            $image = Image::make(public_path($imagePath))->fit(360, 360);
            $image->save();
            $newArray = ['avatar' => $imagePath];
        }

        $user->status = 'active';
        $user->update(array_merge($data, $newArray ?? []));

        return redirect()->route('home');
    }

    public function password(Request $request, User $user)
    {
        $data = $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:6'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password' => Hash::make($request->new_password)]);

        return redirect()->route('home');
    }

}
