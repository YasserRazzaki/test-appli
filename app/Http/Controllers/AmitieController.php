<?php

namespace App\Http\Controllers;
use App\Models\Amitie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AmitieController extends Controller
{
    public function index()
    {
        $amities = Amitie::all();
        return response()->json($amities);
    }
}