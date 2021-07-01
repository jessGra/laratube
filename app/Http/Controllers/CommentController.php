<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Video;

class CommentController extends Controller
{
    public function store(Request $request, Video $video)
    {
        $data = $request->validate([
            'comentario' => 'required | max: 150'
        ]);

        $comentario = new Comment();
        $comentario->user_id = Auth::user()->id;
        $comentario->video_id = $video->id;
        $comentario->body = $data['comentario'];

        $comentario->save();
        return redirect()->route('video.show', $video)->with('status', 'Comentario agregado');
    }

    public function destroy(Video $video, Comment $comment)
    {   
        $userLogged = Auth::user()->id;
        if ($userLogged && ($comment->user_id == $userLogged || $comment->video->user_id == $userLogged)) {
            $comment->delete();
        }
        
        return redirect()->route('video.show', $video)->with('status', 'Comentario Eliminado');
    }
}
