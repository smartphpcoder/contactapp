<?php

namespace App\Models;

use App\Scopes\ContactFilterScope;
use App\Scopes\ContactSearchScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 * @method static orderBy(string $string)
 * @method static create(array $all)
 * @method static latestFirst()
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'email', 'address', 'company_id'];

    public array $filterColumns = ['company_id'];
    public array $searchColumns = ['first_name', 'last_name', 'email', 'company.name'];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeLatestFirst($query)
    {
        return $query->orderBy('id', 'desc');
    }

    /**
     * add global scope to the model
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope(new ContactFilterScope());
        static::addGlobalScope(new ContactSearchScope());
    }
}
