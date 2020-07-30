<?php

namespace ManuelOjeda\Events;

use ManuelOjeda\Contracts\Qualifier;
use ManuelOjeda\Contracts\Rateable;

class ModelUnrated
{
    private Qualifier $qualifier;
    private Rateable $rateable;

    public function __construct(Qualifier $qualifier, Rateable $rateable)
    {
        $this->qualifier = $qualifier;
        $this->rateable = $rateable;
    }

    public function getQualifier(): Qualifier
    {
        return $this->qualifier;
    }

    public function getRateable(): Rateable
    {
        return $this->rateable;
    }
}
