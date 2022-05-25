<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static orderBy(string $string)
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'address', 'website'];

    /**
     * @return HasMany
     */
    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function userCompanies()
    {
        return self::where('user_id', auth()->id())->orderBy('name')->pluck('name', 'id')->prepend('All Companies', '');
    }
}
