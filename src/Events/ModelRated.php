<?php

namespace ManuelOjeda\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use ManuelOjeda\Contracts\Qualifier;
use ManuelOjeda\Contracts\Rateable;

class ModelRated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Qualifier $qualifier;
    private Rateable $rateable;
    private float $score;

    public function __construct(Qualifier $qualifier, Rateable $rateable, float $score)
    {
        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
        $this->score = $score;
    }

    public function getQualifier(): Qualifier
    {
        return $this->qualifier;
    }

    public function getRateable(): Rateable
    {
        return $this->rateable;
    }

    public function getScore(): float
    {
        return $this->score;
    }
}
