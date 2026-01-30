<?php

namespace App\Domains\User\Models;

use App\Domains\Project\Model\Project;
use App\Domains\Shared\Model\Role;
use App\Domains\TimeEntry\Model\TimeEntry;
use App\Domains\User\DataTransferObjects\FilterUserData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'first_name',
        'surname',
        'last_name',
        'email',
        'password',
        'role_id',
        'is_banned'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function timeEntries(): HasMany
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function projectEmployee(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'user_projects');
    }

    public function projectManager(): HasMany
    {
        return $this->hasMany(Project::class, 'manager_id');
    }

    public function getRoleNameAttribute(): ?string
    {
        return $this->role?->role;
    }

    public function getJWTIdentifier(): string
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function scopeFilter($query, FilterUserData $filter)
    {
        return $query
            ->when($filter->role_id, fn ($q) => $q->where('role_id', $filter->role_id))
            ->when($filter->is_banned, fn ($q) => $q->where('is_banned', $filter->is_banned))
            ->when($filter->search, fn ($q) => $q->where(function ($qq) use ($filter) {
                $qq->where('first_name', 'ilike', "%{$filter->search}%")
                    ->orWhere('surname', 'ilike', "%{$filter->search}%")
                    ->orWhere('email', 'ilike', "%{$filter->search}%");
            }));
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
