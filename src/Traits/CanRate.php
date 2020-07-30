<?php

namespace ManuelOjeda\Traits;

use Illuminate\Database\Eloquent\Model;
use ManuelOjeda\Contracts\Rateable;
use ManuelOjeda\Events\ModelRated;
use ManuelOjeda\Events\ModelUnrated;
use ManuelOjeda\Exceptions\InvalidScore;

trait CanRate
{
    public function ratings($model = null)
    {
        $modelClass = $model ? (new $model)->getMorphClass() : $this->getMorphClass();

        $morphToMany = $this->morphToMany(
            $modelClass,
            'qualifier',
            'ratings',
            'qualifier_id',
            'rateable_id'
        );

        $morphToMany
            ->as('rating')
            ->withTimestamps()
            ->withPivot('rateable_type', 'score')
            ->wherePivot('rateable_type', $modelClass)
            ->wherePivot('qualifier_type', $this->getMorphClass());

        return $morphToMany;
    }

    public function rate(Rateable $model, float $score, string $comments = null): bool
    {
        if ($this->hasRated($model)) {
            return false;
        }

        $from = config('rating.from');
        $to = config('rating.to');

        if ($score < $from || $score > $to) {
            throw new InvalidScore($from, $to);
        }

        $this->ratings($model)->attach($model->getKey(), [
            'score' => $score,
            'comments' => $comments,
            'rateable_type' => get_class($model),
        ]);

        event(new ModelRated($this, $model, $score));

        return true;
    }

    public function unrate(Model $model): bool
    {
        if (! $this->hasRated($model)) {
            return false;
        }

        $this->ratings($model->getMorphClass())->detach($model->getKey());

        event(new ModelUnrated($this, $model));

        return true;
    }

    public function hasRated(Rateable $model): bool
    {
        return ! is_null($this->ratings($model->getMorphClass())->find($model->getKey()));
    }
}
