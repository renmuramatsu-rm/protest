<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserinfoOldTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $profile = new \App\Models\Profile([
            'user_id' => $user->id,
            'name' => 'テストユーザー',
            'postcode' => '123-4567',
            'address' => '東京都新宿区',
            'building' => '東京マンション',
            'image' => 'profile_images/sample.jpg',]);
        $profile->save();

        $response = $this->actingAs($user);

        $response = $this->get('/mypage/profile');


        $response->assertStatus(200);
        $response->assertSee($user->name);
        $response->assertSee('123-4567');
        $response->assertSee('東京都新宿区');
        $response->assertSee('東京マンション');
        $response->assertSee('profile_images/sample.jpg');
    }
}
