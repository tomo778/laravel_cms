<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;
use App\Services\CartService;

class CartTest extends TestCase
{
    public $test_data;

    public function setUp(): void
    {
        parent::setUp();
        $this->test_data =
            array(
                'items' =>
                array(
                    2 =>
                    array(
                        'id' => 2,
                        'status' => 1,
                        'title' => '商品名2',
                        'text' => '説明文2',
                        'price' => 1000,
                        'num' => 52,
                        'file_name' => NULL,
                        'quantity' => '3',
                    ),
                    1 =>
                    array(
                        'id' => 1,
                        'status' => 1,
                        'title' => '商品名1',
                        'text' => '商品名1商品名1商品名1',
                        'price' => 3000,
                        'num' => 74,
                        'file_name' => 'xxxx.jpg',
                        'quantity' => '1',
                    ),
                ),
                'price' => 6000,
            );
    }

    public function test_cart__カートから指定idのデータが消えること()
    {
        // Arrange
        session(['cart' => $this->test_data]);

        // Act
        (new CartService())->removeItem(1);

        // Assert
        $this->assertSame(session('cart.items.2.id'), 2);
    }

    public function test_cart__カートのデータの数量が変更できること()
    {
        // Arrange
        session(['cart' => $this->test_data]);
        $request = new Request;
        $request->merge([
            'id' => 2,
            'quantity' => 2,
        ]);
        // Act
        (new CartService())->quantityChange($request);

        // Assert
        $this->assertSame(session('cart.items.2.quantity'), 2);
        $this->assertSame(session('cart.price'), 5000);
    }

    public function test_cart__カートに同じidのデータが入らないこと()
    {
        // Arrange
        session(['cart' => $this->test_data]);
        $request = new Request;
        $request->merge([
            'item_id' => 2,
            'quantity' => 2,
        ]);
        // Act
        $bool = (new CartService())->cartCheck($request);

        // Assert
        $this->assertTrue($bool);
    }

    public function test_cart__カートに指定idのデータが入ること()
    {
        // Arrange
        session(['cart' => $this->test_data]);
        $request = new Request;
        $request->merge([
            'item_id' => 3,
            'quantity' => 2,
        ]);
        // Act
        $bool = (new CartService())->cartCheck($request);

        // Assert
        $this->assertFalse($bool);
        $this->assertSame(session('cart.items.3.id'), 3);
    }

    public function test_cart__カート空の状態で指定idのデータが入ること()
    {
        // Arrange
        $request = new Request;
        $request->merge([
            'item_id' => 3,
            'quantity' => 2,
        ]);
        // Act
        $bool = (new CartService())->cartCheck($request);

        // Assert
        $this->assertFalse($bool);
        $this->assertSame(session('cart.items.3.id'), 3);
    }
}
