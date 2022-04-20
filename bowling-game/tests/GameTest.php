<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use swkberlin\Game;

require __DIR__ . '/../vendor/autoload.php';

class GameTest extends TestCase
{
    protected function setUp(): void
    {
        $this->game = new Game();
    }

    public function test_gutter_game(): void
    {
        $this->rollMany(20, 0);
        $this->assertScore(0);
    }

    public function test_all_ones(): void
    {
        $this->rollMany(20, 1);
        $this->assertScore(20);
    }

    public function test_spare(): void
    {
        $this->rollSeveral(5, 5, 3);
        $this->assertScore(16);
    }

    public function test_strike(): void
    {
        $this->rollSeveral(10, 2, 3);
        $this->assertScore(20);
    }

    public function test_strike_and_spare(): void
    {
        $this->rollSeveral(10, 10, 1, 3);
        $this->assertScore(39);
    }

    public function test_perfect_game(): void
    {
        $this->rollMany(12, 10);
        $this->assertScore(300);
    }

    private function rollMany(int $rolls, int $pins): void
    {
        for ($i = 0; $i < $rolls; $i++) {
            $this->game->roll($pins);
        }
    }

    private function rollSeveral(int ...$pins): void
    {
        foreach ($pins as $pin) {
            $this->game->roll($pin);
        }
    }

    protected function assertScore(int $score): void
    {
        $this->assertEquals($score, $this->game->score());
    }
}
