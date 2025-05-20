<?php

namespace Tests\Feature\Test;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;

class ItemshowTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_item_show()
    {
        $seller = User::factory()->create();
        $purchaser = User::factory()->create();
        $item = Item::first();
        $item->user_id = $seller->id;
        $item->purchase_user_id = $purchaser->id;
        $item->save();

        $this->actingAs($purchaser);
        $response = $this->get('/');
        $response->assertSee($item->name);
        $response->assertSee('Sold Out');

}
}