<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\News;
use App\Models\Player;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(3)->get();
        $players = Player::latest()->take(3)->get();
        $fixtures = Fixture::latest()->take(3)->get();

        return view('home', compact(
            'news',
            'fixtures',
            'players'
        ));
    }
}
