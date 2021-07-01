<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $usuario)
    {   
        $videos = Video::where('status', 'aproved')
        ->where('user_id','=',$usuario->id)
        ->orderBy('created_at', 'DESC')
        ->paginate(10);
        return view('users.show', compact('usuario', 'videos'));
    }
}
