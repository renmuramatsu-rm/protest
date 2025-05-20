<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_login(): void
    {
        $response = $this->followingRedirects()->post(
            '/login',
            [

                'password' => 'password123',
            ]);

        // dd($response->getContent());
        $response->assertSee('パスワードを入力してください');
    }
}
