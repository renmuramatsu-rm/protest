<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ItemsellTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();

        Storage::fake('public');
        $testImagePath = base_path('tests/test-files/sample.png');
        $storedPath = Storage::disk('public')->putFile('images', new \Illuminate\Http\File($testImagePath));

        $response = $this->actingAs($user);
        $response = $this->post('/sell', [
            'category' => [1],
            'condition_id' => '1',
            'name' => 'テスト商品',
            'brandname' => 'サンプルブランド',
            'description' => 'これはテスト用の商品説明です。',
            'price' => 5000,
            'image' => $storedPath,
        ]);

        $response->assertRedirect('/mypage');
        $this->assertDatabaseHas('items', [
            'category' => [1],
            'condition_id' => '1',
            'name' => 'テスト商品',

            'brandname' => 'サンプルブランド',
            'description' => 'これはテスト用の商品説明です。',
            'price' => 5000,
            'user_id' => $user->id,
        ]);
    }
}