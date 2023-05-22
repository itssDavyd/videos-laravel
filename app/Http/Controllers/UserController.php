<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Video;
use App\Models\Comment;
use App\Models\User;

class UserController extends Controller
{
    public function channel($user_id)
    {
        $user = User::find($user_id);

        if (!is_object($user)) {
            return redirect()->route('home')->with(['message' => 'El channel del ' . $user_id . ' no existe en los registros.']);
        }

        $videos = Video::where('user_id', $user_id)->paginate(5);

        return view('User.channel', ['user' => $user, 'videos' => $videos]);
    }
}
