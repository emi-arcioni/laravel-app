<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp;
use App\Exceptions\EnvironmentVariableNotFoundException;

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
        try {
            $response = $client->request('GET', 'https://api.twitter.com/1.1/statuses/user_timeline.json?exclude_replies=true&screen_name=' . $user_id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ]
            ]);
        } catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
        }

        return json_decode($response->getBody(), true);
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
}
