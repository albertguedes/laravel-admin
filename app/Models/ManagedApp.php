<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ManagedApp extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'api_url',
        'api_token',
        'is_active',
    ];

    protected $hidden = ['api_token'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function admins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'admin_app_user')
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->admins();
    }
}
