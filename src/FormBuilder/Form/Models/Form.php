<?php

namespace FormBuilder\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    public const TABLE = 'forms';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'fields',
    ];

    protected $casts = [
        'fields' => 'array',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['name'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')->orWhere('slug', 'like', '%' . $search . '%');
        });
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }
}
