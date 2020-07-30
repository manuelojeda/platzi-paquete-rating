<?php

namespace ManuelOjeda\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Gate;

class Rating extends Pivot
{
    public $incrementing = true;

    protected $table = 'ratings';

    public function rateable()
    {
        return $this->morphTo();
    }

    public function qualifier()
    {
        return $this->morphTo();
    }

    public function approve()
    {
        $this->approved_at = Carbon::now();
    }
    
    public function list()
    {
        // $this->approved_at = Carbon::now();
        Gate::authorize('admin');
        $builder = Rating::query();

        return $builder;
    }
}
