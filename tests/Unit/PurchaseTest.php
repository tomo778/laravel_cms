<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\PurchaseService;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersHistory;
use App\Exceptions\PurchaseException;
use Mockery;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase;

    protected $UsersHistory;
    public $test_data;
    public $test_data2;

    public function setUp(): void
    {
        parent::setUp();

        $this->UsersHistory = new UsersHistory();

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

        $this->test_data2 =
            array(
                'items' =>
                array(
                    1 =>
                    array(
                        'id' => 1,
                        'status' => 1,
                        'title' => '商品名1',
                        'text' => '商品名1商品名1商品名1',
                        'price' => 3000,
                        'num' => 74,
                        'file_name' => 'xxxx.jpg',
                        'quantity' => '999',
                    ),
                ),
                'price' => 6000,
            );
    }

    public function test_Purchase_決済_成功()
    {
        // Arrange
        $m = Mockery::mock('overload:\App\Services\Payment\PaymentFactory');
        $m->shouldReceive('create->execute')->andReturn(true);
        session(['cart' => $this->test_data]);
        session(['purchase.payway' => Config('const.PAYWAY_DELIVERY')]);

        // Act
        $var = (new PurchaseService())->purchase();

        // Assert
        $this->assertNull($var);
    }

    public function test_Purchase_決済_失敗()
    {
        // Arrange
        $m = Mockery::mock('overload:\App\Services\Payment\PaymentFactory');
        $m->shouldReceive('create->execute')->andReturn(false);
        session(['cart' => $this->test_data]);
        session(['purchase.payway' => Config('const.PAYWAY_DELIVERY')]);

        // Act
        $this->expectException(PurchaseException::class);
        (new PurchaseService())->purchase();

        // Assert
        $this->fail('例外無し');
    }

    public function test_Purchase_セッションのpurchaseにデータが追加されること()
    {
        // Arrange
        $id = 1;
        session(['purchase' => '']);
        Auth::loginUsingId($id);

        // Act
        (new PurchaseService())->addSessionData();

        // Assert
        $this->assertSame(session('purchase.user_id'), $id);
        $this->assertSame(session('purchase.user_name'), 'admin');
    }

    public function test_Purchase_セッションのpurchaseとcartが消えること()
    {
        // Arrange
        session(['purchase' => '']);
        session(['cart' => '']);

        // Act
        (new PurchaseService())->saveSession();

        // Assert
        $this->assertSame(session('purchase'), null);
        $this->assertSame(session('cart'), null);
    }

    public function test_Purchase_購入履歴が追加されること()
    {
        // Arrange
        session(['cart' => $this->test_data]);
        session(['purchase.user_id' => 1]);
        session(['purchase.order_id' => 'xxx']);
        session(['purchase.date' => '2024-04-04 00:00:00']);

        // Act
        (new PurchaseService())->addOrderHistory();

        // Assert
        $this->assertDatabaseHas($this->UsersHistory, [
            'id' => 3,
            'user_id' => 1,
            'order_id' => 'xxx',
        ]);
        $this->assertDatabaseHas($this->UsersHistory, [
            'id' => 4,
            'user_id' => 1,
            'order_id' => 'xxx',
        ]);
    }

    public function test_Purchase_対象商品在庫なしエラー()
    {
        // Arrange
        session(['cart' => $this->test_data2]);

        // Act
        $this->expectException(PurchaseException::class);
        (new PurchaseService())->purchase();

        // Assert
        $this->fail('例外無し');
    }
}
