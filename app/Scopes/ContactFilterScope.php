<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ContactFilterScope extends FilterScope
{
    protected array $filterColumns = ['company_id'];
}
