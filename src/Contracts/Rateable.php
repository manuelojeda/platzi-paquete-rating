<?php

namespace ManuelOjeda\Contracts;

use Illuminate\Database\Eloquent\Model;

interface Rateable extends Model
{
    public function averageRating(): float;

    public function getKey();

    public function name(): string;

    public function qualifications();

    public function hasRateBy(Qualifier $model): bool;
}
