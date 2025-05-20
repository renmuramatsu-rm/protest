<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Artisan;


class ItemlikeTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_Like()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::first();

        $response = $this->post("/item/{$item->id}/like");
        $response->assertRedirect();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_like_icon()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::first();

        $user->item_likes()->attach($item->id);

        $response = $this->get("/item/{$item->id}");
        $response->assertSee('btn-success__img'); 
    }

    public function test_unlike()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $item = Item::first();

        $user->item_likes()->attach($item->id);

        $response = $this->delete("/item/{$item->id}/unlike");
        $response->assertRedirect();

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}


