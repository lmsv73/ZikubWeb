<?php

namespace App\Http\Controllers;

use App\Music;

class MusicController extends Controller
{
    public function addMusic($id_user, $url, $indice)
    {
        $musicByIndice = Music::where([
                ['id_user', $id_user],
                ['indice', $indice]
            ])->first();

        if($musicByIndice != null) {
            $musicByIndice->url = $url;
            $musicByIndice->save();
        } else {
            $music = new Music();
            $music->url = $url;
            $music->indice = $indice;
            $music->id_user = $id_user;
            $music->save();
        }

        return response()->json(['success' => true]);
    }


    public function getPlaylist($id_user)
    {
        $musics = Music::select('indice', 'url')
            ->join('users', 'users.id', '=', 'music.id_user')
            ->where('users.id', $id_user)
            ->get();

        return response()->json(['playlist' => $musics]);
    }
}

