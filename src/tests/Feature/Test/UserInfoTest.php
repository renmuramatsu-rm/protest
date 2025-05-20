<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserInfoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {

        $user = User::factory()->create();

        $this->actingAs($user);
        $response = $this->get('/mypage/profile');

        $response->assertSee($user->name);
        $response->assertSee($user->image);
        $response->assertSee($user->postcode);
        $response->assertSee($user->address);
        $response->assertSee($user->building);
    }
}
