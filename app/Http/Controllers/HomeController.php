<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    //

    public function show() {
        $user_count = [];
        $items = [];
        $all_entries = Entry::orderBy('created_at', 'desc')->get();
        foreach($all_entries as $entry) {
            $c = array_count_values($user_count);
            if ( empty($c[$entry->user_id]) || $c[$entry->user_id] < 3) {
                $user_count[] = $entry->user_id;
                $items[] = $entry;
            }
        }

        $current_page = LengthAwarePaginator::resolveCurrentPage();
        $per_page = 10;
        $entries = array_slice($items, $per_page * ($current_page - 1), $per_page);
        $paginator = new LengthAwarePaginator($entries, count($items), $per_page, $current_page);
        $paginator->withPath(route('/'));
        
        return view('home', [
            'user' => $this->getUser(),
            'entries' => $entries,
            'paginator' => $paginator
        ]);
    }
}
