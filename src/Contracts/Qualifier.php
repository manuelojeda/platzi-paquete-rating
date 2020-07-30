<?php

namespace ManuelOjeda\Contracts;

interface Qualifier
{
    public function ratings($model = null);

    public function hasRated(Rateable $model): bool;

    public function rate(Rateable $model, float $rating): bool;

    public function unrate(Rateable $model): bool;
}
