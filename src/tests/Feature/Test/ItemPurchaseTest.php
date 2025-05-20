<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Artisan;

class ItemPurchaseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_purchase()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::first();
        $purchaser = User::factory()->create();
        $item->purchase_user_id = $purchaser->id;

        $response = $this->post("/purchase/soldout/{item_id}");

        $response = $this->get('/');
        $response->assertSee($item->name);
    }

    public function test_purchase_sold()
    {
        $user = User::factory()->create();
        $item = Item::first();
        $item->update(['purchase_user_id' => $user->id]);

        $this->actingAs($user);
        $response = $this->get('/');

        $response->assertSee('Sold Out');
    }

    public function test_purchased_item_shows_on_profile()
    {
        $user = User::factory()->create();
        $item = Item::first();
        $purchaser = User::factory()->create();
        $item->purchase_user_id = $purchaser->id;
        $this->actingAs($user);
        $response = $this->get('/mypage');

        $response->assertSee($item->name);
    }
}
