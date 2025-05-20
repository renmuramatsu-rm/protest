<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class AddressTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_address()
    {
        $user = User::factory()->create();
        $item = Item::first();

        $this->actingAs($user);

        $response = $this->post(route('address.create', $item->id), [
            'postcode' => '100-0001',
            'address' => '東京都千代田区',
            'building' => '東京ビル'
        ]);

        $this->assertDatabaseHas('addresses', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'postcode' => '100-0001',
            'address' => '東京都千代田区',
            'building' => '東京ビル'
        ]);

        $response->assertSee('100-0001');
        $response->assertSee('東京都千代田区 東京ビル');
    }
}


