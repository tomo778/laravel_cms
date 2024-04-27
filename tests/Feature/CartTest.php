<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


use Database\Seeders\DatabaseSeeder;

class CartTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_view_cart_add_カート追加画面(): void
    {
        $response = $this->post(
            '/cart',
            [
                'item_id' => 2,
                'quantity' => 3,
            ]
        );
        $response = $this->post(
            '/cart',
            [
                'item_id' => 3,
                'quantity' => 1,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertSee('合計4,000円');
    }

    public function test_view_cart_remove_カート削除画面(): void
    {
        $response = $this->post(
            '/cart',
            [
                'item_id' => 2,
                'quantity' => 3,
            ]
        );
        $response = $this->post(
            '/cart',
            [
                'item_id' => 3,
                'quantity' => 1,
            ]
        );
        $response = $this->post(
            '/cart/remove',
            [
                'id' => 2,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(array('success' => true), $strict = false)
            ->assertSessionHas('cart.price', 1000)
            ->assertSessionMissing('cart.items.2');
    }

    public function test_view_cart_quantity_カート数量画面(): void
    {
        $response = $this->post(
            '/cart',
            [
                'item_id' => 2,
                'quantity' => 3,
            ]
        );
        $response = $this->post(
            '/cart/quantity',
            [
                'id' => 2,
                'quantity' => 1,
            ]
        );

        $response
            ->assertStatus(200)
            ->assertJson(array('success' => true), $strict = false)
            ->assertSessionHas('cart.price', 1000)
            ->assertSessionHas('cart.items.2.quantity', 1);
    }
}
