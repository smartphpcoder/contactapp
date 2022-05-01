<?php

namespace App\Scopes;

class ContactSearchScope extends SearchScope
{
    protected array $searchColumns = ['first_name', 'last_name', 'email', 'company.name'];
}
