<?php

namespace Tests\Feature\Test;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;


class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_RegisterName(): void
    {
        // 名前が入力されていない場合、バリデーションメッセージが表示される
        $response = $this->post('/register', [

            'email'                 => 'test@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ])->followingRedirects();

        $response->assertStatus(302);
        $response->assertRedirect('/register');
    }

    // public function test_RegisterMail(): void
    // {
    //     // メールアドレスが入力されていない場合、バリデーションメッセージが表示される
    //     $response = $this->followingRedirects()->post('/register', [
    //         'name'                  => 'ren',
    //         'password'              => 'password123',
    //         'password_confirmation' => 'password123',
    //     ]);
    //     $response->assertSee('メールアドレスを入力してください');
    // }

    // public function test_RegisterPassword(): void
    // {
    //     // パスワードが入力されていない場合、バリデーションメッセージが表示される
    //     $response = $this->followingRedirects()->post('/register', [
    //         'name'                  => 'ren',
    //         'email'                 => 'test@example.com',
    //         'password_confirmation' => 'password123',
    //     ]);
    //     $response->assertSee('パスワードを入力してください');
    // }

    // public function test_RegisterPassword2(): void
    // {
    //     // パスワードが7文字以下の場合、バリデーションメッセージが表示される
    //     $response = $this->followingRedirects()->post('/register', [
    //         'name'                  => 'ren',
    //         'email'                 => 'test@example.com',
    //         'password'              => 'pass123',
    //         'password_confirmation' => 'pass123',
    //     ]);

    //     $response->assertSee('パスワードは8文字以上で入力してください');
    // }

    // public function test_RegisterPassword3(): void
    // {
    //     // パスワードが確認用パスワードと一致しない場合、バリデーションメッセージが表示される
    //     $response = $this->followingRedirects()->post('/register', [
    //         'name'                  => 'ren',
    //         'email'                 => 'test@example.com',
    //         'password'              => 'password123',
    //         'password_confirmation' => 'password12',
    //     ]);

    //     $response->assertSee('パスワードと一致しません');
    // }

    // protected function tearDown(): void
    // {
    //     parent::tearDown();
    // }
}
