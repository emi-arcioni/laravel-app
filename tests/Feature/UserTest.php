<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class UserTest extends TestCase
{
    
    public function testItCantLogInWithBadCredentials()
    {
        $user = User::inRandomOrder()->first();

        $response = $this->post('http://emilio-arcioni.jobsitychallenge.com/login', [
            'username' => $user['username'],
            'password' => $user['password']
        ]);

        $this->assertGuest();
    }
}
