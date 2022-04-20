<?php

namespace swkberlin;

class Game
{
    private int $score = 0;
    private int $roll = 0;
    private int $scoreRolls = 0;
    private array $rolls;

    public function __construct()
    {
        $this->rolls = array_fill(0, 21, 0);
    }

    public function score(): int
    {
        $this->scoreRolls = 0;
        for ($frame = 0; $frame < 10; $frame++) {
            if ($this->currentFrameIsStrike()) {
                $this->scoreStrikeFrame();
            } else if ($this->currentFrameIsSpare()) {
                $this->scoreSpareFrame();
            } else {
                $this->scoreRegularFrame();
            }
        }

        return $this->score;
    }


    public function roll(int $int): void
    {
        $this->rolls[$this->roll] = $int;
        $this->roll++;
    }

    protected function frameScore(): int
    {
        return $this->rolls[$this->scoreRolls] + $this->rolls[$this->scoreRolls + 1];
    }

    private function scoreStrikeFrame(): void
    {
        $this->score += 10 + $this->rolls[$this->scoreRolls + 1] + $this->rolls[$this->scoreRolls + 2];
        $this->scoreRolls++;
    }

    private function scoreSpareFrame(): void
    {
        $this->score += 10 + $this->rolls[$this->scoreRolls + 2];
        $this->scoreRolls += 2;
    }

    private function scoreRegularFrame(): void
    {
        $this->score += $this->frameScore();
        $this->scoreRolls += 2;
    }

    private function currentFrameIsStrike(): bool
    {
        return $this->rolls[$this->scoreRolls] === 10;
    }

    private function currentFrameIsSpare(): bool
    {
        return $this->frameScore() === 10;
    }

}
