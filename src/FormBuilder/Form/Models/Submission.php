<?php

namespace FormBuilder\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Submission extends Model
{
    use HasUuids, HasFactory, SoftDeletes;

    public const TABLE = 'forms_submissions';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
}
