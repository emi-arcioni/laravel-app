<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Entry;
use App\User;
use App\Http\Controllers\TwitterController;

class EntryController extends Controller
{
    protected $twitterController;

    public function __construct(TwitterController $twitterController) {
        $this->twitterController = $twitterController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $entries = Entry::where('user_id', $user_id)->get();
        $user = User::where('id', $user_id)->firstOrFail();
        $tweets = $this->twitterController->getTweets($user->twitter_username);

        return view('entries.list', [
            'user' => $user,
            'loggedUser' => $this->getUser(),
            'entries' => $entries,
            'tweets' => $tweets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($user_id)
    {
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return redirect('/');

        return view('entries.form', [
            'user' => $this->getUser(),
            'entry' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required']
        ]);
        
        $entry = new Entry;
        $entry->title = $request->title;
        $entry->content = $request->content;
        $entry->user_id = $this->getUser()->id;
        $entry->save();

        return redirect('/users/' . $entry->user_id . '/entries/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id, $entry_id)
    {
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return redirect('/');

        $entry = Entry::where('id', $entry_id)->firstOrFail();
        return view('entries.form', [
            'user' => $this->getUser(),
            'entry' => $entry
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $entry_id)
    {
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return redirect('/');

        $this->validate($request, [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required']
        ]);

        $entry = Entry::find($entry_id);
        $entry->title = $request['title'];
        $entry->content = $request['content'];
        $entry->save();

        return redirect('/users/' . $entry->user_id . '/entries/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id, $entry_id)
    {
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return redirect('/');
        
        return Entry::where('id', $entry_id)->delete();
    }
}
