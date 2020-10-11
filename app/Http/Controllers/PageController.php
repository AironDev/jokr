<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        return view('index');
    }

}
