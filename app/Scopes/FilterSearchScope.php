<?php

namespace App\Scopes;

trait FilterSearchScope
{
    /**
     * add global scope to the model
     * @return void
     */
    protected static function bootFilterSearchScope()
    {
        static::addGlobalScope(new SearchScope());
        static::addGlobalScope(new FilterScope());
    }
}
