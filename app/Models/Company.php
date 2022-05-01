<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static orderBy(string $string)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'website'];

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }
}
