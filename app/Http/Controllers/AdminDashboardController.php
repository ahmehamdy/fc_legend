<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use App\Models\News;
use App\Models\Player;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index(){

        $total_players = Player::count();
        $total_news = News::count();
        $total_fixtures = Fixture::count();
        $total_staff = User::count();

        return view('admin.dashboard',compact(
            'total_players',
            'total_news',
            'total_fixtures',
            'total_staff',
        ));

    }

}
