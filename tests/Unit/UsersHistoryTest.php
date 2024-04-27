<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\UsersHistoryService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsersHistoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_history_購入履歴があるユーザは、履歴が返ること()
    {
        // Arrange
        Auth::loginUsingId(1);

        // Act
        $result = (new UsersHistoryService())->list();

        // Assert
        $this->assertFalse($result->isEmpty());
    }

    public function test_user_history_購入履歴が無いユーザは、空が返ること()
    {
        // Arrange
        Auth::loginUsingId(2);

        // Act
        $result = (new UsersHistoryService())->list();

        // Assert
        $this->assertTrue($result->isEmpty());
    }
}
