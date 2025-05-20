<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Artisan;

class MylistTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    /**
     * A basic feature test example.
     */
    public function test_Mylist()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $items = Item::all();
        $likedItem = $items[0];
        $user->item_likes()->attach($likedItem->id);

        $notLikedItem = $items->get(1);
        $myItem = $items->get(2);

        $soldItem = $items->get(3);
        $soldItem->purchase_user_id = User::factory()->create()->id;
        $soldItem->save();
        $user->item_likes()->attach($soldItem->id);

        $response = $this->get('/?tab=mylist');

        $response->assertSee($likedItem->name);
        $response->assertSee($soldItem->name);
        $response->assertSee('Sold Out');
        $response->assertDontSee($notLikedItem->name);
        $response->assertDontSee($myItem->name);
    }

    public function test_mylist_guest()
    {
        $item = Item::first();
        $user = User::factory()->create();
        $user->item_likes()->attach($item->id);

        $response = $this->get('/?tab=mylist');
        $response->assertDontSee($item->name);
    }
}
