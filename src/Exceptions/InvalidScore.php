<?php

namespace ManuelOjeda\Exceptions;

use Exception;

class InvalidScore extends Exception
{
    public int $from;
    public int $to;

    public function __construct(int $from, int $to)
    {
        $this->from = $from;
        $this->to = $to;
    }

    public function render ()
    {
        return response()->json(
            [
                'score' => trans('rating.invalidScore', [
                    'from' => $this->from,
                    'to' => $this->to,
                ])
            ]
        );
    }
}
