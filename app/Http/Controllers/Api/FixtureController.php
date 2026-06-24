<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Fixture;
use Illuminate\Http\Request;

class FixtureController extends Controller
{
    public function index()
    {
        $fixture = Fixture::last(10)->get();
        return response()->json([
            'message'=>'all fixtures',
            'fixture'=>$fixture
        ]);
    }
}
