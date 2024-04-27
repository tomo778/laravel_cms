<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\CategoryService;

class CategoryTest extends TestCase
{
    public function test_Category_対象idのカテゴリが無い場合例外になること()
    {
        // Arrange
        $id = 9999;
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        // Act
        (new CategoryService())->CategoryData($id);
    }

    public function test_Category_対象idのカテゴリデータが返ること()
    {
        // Arrange
        $id = 1;

        // Act
        $result = (new CategoryService())->CategoryData($id);

        // Assert
        $this->assertSame($id, $result->id);
    }
}
