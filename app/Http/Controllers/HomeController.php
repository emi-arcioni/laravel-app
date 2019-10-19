<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class HomeController extends Controller
{
    //

    public function show() {
        $entries = Entry::get();

        return view('home', [
            'user' => $this->getUser(),
            'entries' => $entries
        ]);
    }
}
