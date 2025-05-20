<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Artisan;

class SearchTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    /**
     * A basic feature test example.
     */
    public function testSearch()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/search?keyword=時計');
        $response->assertSee('腕時計');
        $response->assertDontSee('HDD');
    }

    public function testSearch_mylist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $items = Item::all();
        $likedItem = $items[0];
        $likedItem2 = $items[1];

        $user->item_likes()->attach([$likedItem->id, $likedItem2->id]);

        $response = $this->get('/search?tab=mylist&keyword=HDD');
        $response->assertSee('HDD');
        $response->assertDontSee('時計');
}
}