<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::get();

        return view('users.user', ['users' => $users]);
    }
    public function tambah()
    {
        return view('users.tambah');
    }
    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);
        $user =  User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'password' => Hash::make($request['password']),
        ]);
        $user->assignRole('user');
        session()->flash('success', 'User berhasil dibuat.');


        return redirect('/user');
    }
    public function delete(User $user)
    {
        $user->delete();
        session()->flash('success', 'User berhasil dihapus.');

        return redirect('/user');
    }
    public function ubahPassword($id)
    {
        $user = User::find($id);
        return view('users.ubah-password', ['user' => $user]);
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8']
        ]);
        User::find($request->id)->update([
            'password' => Hash::make($request['password'])
        ]);
        session()->flash('success', 'Password berhasil diubah.');

        return redirect()->route('user');
    }
}
