<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use App\Exceptions\EnvironmentVariableNotFoundException;
use App\HiddenTweet;
use App\User;

class TwitterController extends Controller
{
    public function getTweets($user_id) {
        try {
            $token = $this->loadToken();
        } catch (EnvironmentVariableNotFoundException $e) {
            $response = [
                "errors" => [
                    [
                        'message' => $e->getMessage(),
                        'label' => 'env_variable_error'
                    ]
                ]
            ];
            return $response;
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            return json_decode($response->getBody(), true);
        }

        $client = new GuzzleHttp\Client();
        $user = User::where('id', $user_id)->firstOrFail();
        $twitter_username = $user->twitter_username;

        try {
            $response = $client->request('GET', 'https://api.twitter.com/1.1/statuses/user_timeline.json?exclude_replies=true&screen_name=' . $twitter_username, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            return json_decode($response->getBody(), true);
        }

        $hidden_tweets = HiddenTweet::where('user_id', $user->id)->get();
        $hidden_tweets_ids = array_column($hidden_tweets->toArray(), 'tweet_id');

        $tweets = json_decode($response->getBody());
        $loggedUser = $this->getUser();
        foreach($tweets as $i => $tweet) {
            $tweets[$i]->hidden = in_array($tweet->id, $hidden_tweets_ids);
            if ($tweet->hidden && !$loggedUser) {
                unset($tweets[$i]);
            }
        }
        
        return array_values($tweets);
    }

    private function loadToken() {
        
        if (!$key = env('TWITTER_API_KEY')) {
            throw new EnvironmentVariableNotFoundException('The environment variable TWITTER_API_KEY is missing or empty');
        }
        if (!$secret = env('TWITTER_API_SECRET')) {
            throw new EnvironmentVariableNotFoundException('The environment variable TWITTER_API_SECRET is missing or empty');
        }

        $client = new GuzzleHttp\Client(['auth' => [$key, $secret]]);

        $response = $client->request('POST', 'https://api.twitter.com/oauth2/token', [
            'form_params' => [
                'grant_type' => 'client_credentials'
            ]
        ]);
        $body = json_decode($response->getBody());
        return $body->access_token;
    }

    public function hideTweet($user_id, $tweet_id) {
        // TODO: maybe this could be resolved using a GATE
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return abort(403);

        $hidden_tweet = HiddenTweet::where('tweet_id', $tweet_id)->where('user_id', $user_id)->first();
        if (!$hidden_tweet) {
            $hidden_tweet = new HiddenTweet;
            $hidden_tweet->user_id = $loggedUser->id;
            $hidden_tweet->tweet_id = $tweet_id;
            $hidden_tweet->save();
        }
        return response()->json([], 200);        
    }
    
    public function unhideTweet($user_id, $tweet_id) {
        // TODO: maybe this could be resolved using a GATE
        $loggedUser = $this->getUser();
        if ($loggedUser->id != $user_id) return abort(403);
        
        HiddenTweet::where('tweet_id', $tweet_id)->where('user_id', $user_id)->delete();
        return response()->json([], 200);
    }
}
