<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Support\Facades\Artisan;

class ItemCommentTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:fresh --seed');
    }

    public function test_comment()
    {
        $user = User::factory()->create();
        $item = Item::first();

        $this->actingAs($user);
        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => 'これはテストコメントです',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'これはテストコメントです',
        ]);
    }

    public function test_guest_comment()
    {
        $item = Item::first();

        $response = $this->post("/item/{$item->id}/comment", [
            'comment' => 'ゲスト投稿',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('comments', ['comment' => 'ゲスト投稿']);
    }

    public function test_comment_validation()
    {
        $user = User::factory()->create();
        $item = Item::first();
        $this->actingAs($user);

        $response = $this->followingRedirects()->post("/item/{$item->id}/comment", [
            'comment' => '',
        ]);

        $response->assertSee('コメントを入力してください');
    }

    public function test_comment_max_length_validation()
    {
        $user = User::factory()->create();
        $item = Item::first();
        $this->actingAs($user);

        $longComment = str_repeat('あ', 256);
        $response = $this->followingRedirects()->post("/item/{$item->id}/comment", [
            'comment' => $longComment,
        ]);

        $response->assertSee('コメントは255文字以内で入力してください');
    }
}

