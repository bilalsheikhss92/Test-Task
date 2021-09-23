<?php

namespace App\Http\Controllers;

use App\Video;
use App\VideoTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VideoController extends Controller
{
    //
    public function index()
    {
        $videos = Video::all();
        return view('videos.index', compact('videos'));
    }
    public function create()
    {
        return view('videos.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'tag' => 'required|string',
            'video' => 'required|file'
        ]);
        if ($request->video != NULL) {
            $videoName = '/videos/' . time() . '.' . $request->video->extension();
            $request->video->move(public_path('videos'), $videoName);
        }
        $video = Video::create([
            'name' => $request->name,
            'description' => $request->description,
            'video' => $videoName,
        ]);
        $path = "c:/7.4/htdocs/Test-Task/public/videos/";
        $orignalName = str_replace("/videos/", "", $videoName);
        $filename =  strstr($orignalName, '.', true);
        $convertedName = "/videos/" . $filename . ".m3u8";
        $cmd = "c:/ffmpeg/bin/ffmpeg -i " . $path . $orignalName . " " . $path . $filename . ".m3u8";
        // return $cmd;
        shell_exec($cmd);
        $video->update([
            'conversion_status' => 'converted',
            'converted_name' => $convertedName
        ]);
        $tags = explode(",", $request->tag);
        foreach ($tags as $tag) {
            VideoTag::create([
                'video_id' => $video->id,
                'tag' => $tag,
            ]);
        }
        return redirect()->route('home');
    }

    public function show($id)
    {
        $video = Video::findorFail($id);
        $tags = VideoTag::where('video_id', $video->id)->get();


        return view('videos.view', compact('video', 'tags'));
    }

    public function edit($id)
    {
        $video = Video::findorFail($id);
        $tags = VideoTag::where('video_id', $video->id)->get();

        return view('videos.edit', compact('video', 'tags'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'tag' => 'required|string',
        ]);
        $video = Video::findorFail($id);
        if ($request->hasFile('video')) {
            $videoName = '/videos/' . time() . '.' . $request->video->extension();
            $request->video->move(public_path('videos'), $videoName);

            $path = "c:/7.4/htdocs/Test-Task/public/videos/";
            $orignalName = str_replace("/videos/", "", $videoName);;
            $filename =  strstr($orignalName, '.', true);
            $convertedName = "/videos/" . $filename . ".m3u8";
            $cmd = "c:/ffmpeg/bin/ffmpeg -i " . $path . $orignalName . " " . $path . $filename . ".m3u8";
            // return $cmd;
            shell_exec($cmd);
            $conversion_status = 'converted';
        } else {
            $videoName = $video->video;
            $convertedName = $video->converted_name;
            $conversion_status = $video->conversion_status;
        }
        $video->update([
            'name' => $request->name,
            'description' => $request->description,
            'video' => $videoName,
            'conversion_status' => $conversion_status,
            'converted_name' => $convertedName
        ]);

        $pTags = VideoTag::where('video_id', $video->id)->get();

        foreach ($pTags as $dtag) {
            $dtag->delete();
        }
        $tags = explode(",", $request->tag);
        foreach ($tags as $tag) {
            VideoTag::create([
                'video_id' => $video->id,
                'tag' => $tag,
            ]);
        }
        return redirect()->route('home');
    }


    public function delete($id)
    {
        //
        $video = Video::findorFail($id);
        if ($video->video) {
            $deleteOrignal = str_replace("/videos/", "", $video->video);
            File::delete('videos/' . $deleteOrignal);
        }
        if ($video->converted_name) {
            $deleteOrignal = str_replace("/videos/", "", $video->converted_name);
            File::delete('videos/' . $deleteOrignal);
        }
        $video->delete();
        return redirect()->route('home');
    }
}
