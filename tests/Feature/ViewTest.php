<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_view_top_トップ画面(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200)
            ->assertSee('portfolio site')
            ->assertSee('メニュー')
            ->assertSee('お問い合わせ');
    }

    public function test_view_login_ログイン画面(): void
    {
        $response = $this->get('/login');

        $response
            ->assertStatus(200)
            ->assertSee('メニュー')
            ->assertSee('user登録');
    }
}
