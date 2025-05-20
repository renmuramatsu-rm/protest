<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Artisan;

class ItemdetailTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }
    
    public function test_item_detail(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $item = Item::first();
        
        $category = Category::first();
        $item->categories()->attach($category->id);

        $comment = Comment::create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'これはテストです'
        ]);

        $user->item_likes()->attach([$item->id]);

        $response = $this->get("/item/{$item->id}");

        $response->assertSee('products/時計.jpg');
        $response->assertSee('腕時計');
        $response->assertSee('casio');
        $response->assertSee('15000');
        $response->assertSee('1');
        $response->assertSee('1');
        $response->assertSee('スタイリッシュなデザインのメンズ腕時計');
        $response->assertSee('ファッション');
        $response->assertSee('良好');
        $response->assertSee('1');
        $response->assertSee($user->name);
        $response->assertSee('これはテストです');
    }
}
