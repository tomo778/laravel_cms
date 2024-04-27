<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CategoryService;
use App\Services\ProductService;

class ProductTest extends TestCase
{
    public function test_product_商品idを代入_商品データが返ること()
    {
        // Arrange
        $id = 1;

        // Act
        $result = (new ProductService())->detail($id);

        // Assert
        $this->assertSame($id, $result->id);
    }

    public function test_product_商品idに「null」を代入_タイプエラーになること()
    {
        // Arrange
        $id = null;

        $this->expectException(\TypeError::class);
        // Act
        $result = (new ProductService())->detail($id);
    }

    public function test_product_商品一覧_商品一覧が返ること()
    {
        // Arrange

        // Act
        $result = (new ProductService())->list();

        // Assert
        $this->assertSame(1, $result->first()->id);
        $this->assertSame(10, $result->last()->id);
    }

    public function test_product_カテゴリ一覧へカテゴリid代入_カテゴリに紐づいた商品が返ること()
    {
        // Arrange
        $id = 2;

        // Act
        $result = (new ProductService())->categoryList($id);
        foreach ($result->first()->add_category as $k => $v) {
            $first[] = $v['id'];
        }
        foreach ($result->last()->add_category as $k => $v) {
            $last[] = $v['id'];
        }

        // Assert
        $this->assertSame(10, $result->first()->id);
        $this->assertSame(19, $result->last()->id);
        $this->assertTrue(in_array($id, $first, true));
        $this->assertTrue(in_array($id, $last, true));
    }
}
