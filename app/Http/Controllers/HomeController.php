<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Post::with('user')
                        //->first()
                        ->limit('10')
                        ->get();

        return view('home', compact('datas'));
    }
}
