<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Akses Model
use App\User;
use Hash;


class MainController extends Controller
{
    //
    public function index(){
        return "Hi Juga";
    }
    public function hello(){
        return "Hello Juga";
    }
    public function welcome(){
        return view('welcome');
    }
    public function ambildatauser(){
        
        // Akses Model
        $users = User::all();

        $namaweb = "Ari Web";

        return view('user', compact("users","namaweb"));
    }
    public function daftaruser(Request $req){

        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $new = new User;
        $new->name = $req->name;
        $new->password = Hash::make($req->password);
        $new->email = $req->email;
        $new->save();

        return redirect('user')->with('status', 'Data Berhasil Diinput');
    }
}