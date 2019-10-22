<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class EntryTest extends TestCase
{

    public function testItCanShowIndex() {
        $response = $this->get('http://emilio-arcioni.jobsitychallenge.com/');

        $response->assertStatus(200);
    }

    public function testItCanShowEntriesOfUser() {
        $user = User::inRandomOrder()->first();
        $response = $this->get('http://emilio-arcioni.jobsitychallenge.com/users/' . $user['id'] . '/entries');
        $response->assertStatus(200);
    }

    public function testItCanShowEntryForm() {
        $user = User::inRandomOrder()->first();
        $response = $this->actingAs($user)->get('http://emilio-arcioni.jobsitychallenge.com/users/' . $user['id'] . '/entries/create');
        $response->assertStatus(200);
    }

    public function testItRejectEntryForm() {
        $user = User::inRandomOrder()->first();
        $user2 = User::where('id', '!=', $user['id'])->inRandomOrder()->first();

        $response = $this->actingAs($user2)->get('http://emilio-arcioni.jobsitychallenge.com/users/' . $user['id'] . '/entries/create');
        $response->assertStatus(302);
    }

    public function testItCanEditEntryForm() {
        $user = User::with(['entries' => function($query) {
            $query->inRandomOrder()->first();
        }])->inRandomOrder()->first();
        $response = $this->actingAs($user)->get('http://emilio-arcioni.jobsitychallenge.com/users/' . $user['id'] . '/entries/' . $user['entries'][0]['id'] . '/edit');
        $response->assertStatus(200);
    }

    public function testItRejectEditEntryForm() {
        $user = User::with(['entries' => function($query) {
            $query->inRandomOrder()->first();
        }])->inRandomOrder()->first();
        $response = $this->get('http://emilio-arcioni.jobsitychallenge.com/users/' . $user['id'] . '/entries/' . $user['entries'][0]['id'] . '/edit');
        $response->assertStatus(302);
    }

}
