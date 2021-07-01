<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveVideoRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VideoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'getImage', 'getVideo', 'search');
    }

    public function index()
    {
        $videos = Video::where('status', 'aproved')->orderBy('created_at', 'DESC')->paginate(10);
        return view('home', compact('videos'));
    }

    public function show(Video $video)
    {
        $videosList = Video::where('status', 'aproved')
            ->where('id', '!=', $video->id) //para no listar el video que se esta reproducciendo
            ->orderBy('created_at', 'DESC')
            ->take(10)
            ->get();
        if ($video->status == 'aproved') {
            return view('videos.show', compact('video', 'videosList'));
        }
        return redirect()->route('home')->with('status', 'El Video ha sido eliminado y no se puede reproducir');;
    }


    public function create()
    {
        $video = new Video;
        return view('videos.create', compact('video'));
    }

    public function store(SaveVideoRequest $request)
    {
        $dataValidated = $request->validated();

        //creo el objeto video con las propiedades correspondientes y validadas
        $video = new Video();

        //obtengo el id del usuario que esta subiendo el video
        $user = Auth::user();

        //subida de la miniatura v2
        $image_path = $dataValidated['image']->store('images');

        //subida del video
        $video_path = $dataValidated['video']->store('videos');

        $video->user_id = $user->id;
        $video->title = $dataValidated['title'];
        $video->description = $dataValidated['description'];
        $video->slug = Str::slug($dataValidated['title']) . '_' . Str::random(4);
        $video->status = 'aproved';
        $video->image = Str::replace('images/', '', $image_path);
        $video->path = Str::replace('videos/', '', $video_path);

        //dump($video->path);
        $video->save();
        return redirect()->route('home')->with('status', 'Video subido con exito');
    }


    //retorna la imagen desde el almacenamiento
    public function getImage($filename)
    {
        if (!Storage::exists('images/' . $filename)) {
            abort(404);
        }
        $file = Storage::get('images/' . $filename);
        //dump($file);
        return Response($file, 200);
    }

    //retorna el archivo de video desde el almacenamiento
    public function getVideo($filename)
    {
        if (!Storage::exists('videos/' . $filename)) {
            abort(404);
        }
        $file = Storage::get('videos/' . $filename);
        //dump($file);
        return Response($file, 200);
    }


    //cargar formulario para editar el video
    public function edit(Video $video)
    {
        if ($video->status == 'aproved' && $video->user == Auth::user()) {
            return view('videos.edit', compact('video'));
        }
        return redirect()->route('home')->with('status', 'El Video ha sido eliminado o no te pertenece');;
    }


    //almacena en la base de datos el video editado
    public function update(Request $request, Video $video)
    {

        $data = $request->validate([
            'title' => 'required | max: 30',
            'description' => 'required | max: 150',
        ]);

        $video->title = $data['title'];
        $video->description = $data['description'];
        $video->slug = Str::slug($data['title']) . '_' . Str::random(4);

        if (!($request->file('image') == null)) {
            $request->validate([
                'image' => 'required | mimes:jpg,bmp,png,jpeg | max:3000'
            ]);
            //se elimina la anterior
            Storage::disk('images')->delete($video->image);
            //subida de la miniatura
            $image_path = $request['image']->store('images');
            $video->image = Str::replace('images/', '', $image_path);
        }
        $video->update();
        return redirect()->route('video.show', $video)->with('status', 'El Video fue actualizado con exito');
    }

    //elimina un video de la base de datos (SOFTDELETE)
    public function delete(Video $video)
    {
        $video->status = 'deleted';
        $video->update();
        return redirect()->route('home', $video)->with('status', 'El Video fue eliminado con exito');
    }

    //busca videos en la base de datos
    public function search(Request $request, $search = null, $filter = null)
    {
        $search = $request->search;
        $filter = $request->filter;
        $col = 'created_at';
        $order = 'DESC';
        if (is_null($search)) {
            return redirect()->route('home')->with('status', 'especifica una busqueda');
        }
        if (!is_null($filter)) {
            if ($filter == 'reciente') {//recientes primero
                $col = 'created_at';
                $order = 'DESC';
            }
            if($filter == 'antiguo'){//antiguos primero
                $col = 'created_at';
                $order = 'ASC';
            }
            if($filter == 'alfa'){//alfa
                $col = 'title';
                $order = 'ASC';
            }
        }
        $videos = Video::where('title', 'LIKE', '%' . $search . '%')
            ->where('status', 'aproved')
            ->orderBy($col, $order)
            ->paginate(6);
        return view('videos.search', compact('videos', 'search', 'filter'));
    }
}
