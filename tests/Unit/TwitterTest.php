<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Http\Controllers\TwitterController;

class TwitterTest extends TestCase
{
    
    public function testItCanGetToken() {
        $controller = new TwitterController();
        $response = $controller->loadToken();

        $this->assertTrue(is_string($response));
    }
}
