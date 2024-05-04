<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

// ------------------------------------------------------------------------------------------------------
// ATTENTION :
// the user attribute "is_developer" should be set directly in the database
// by the application developer on the one user account he wants to use to manage the whole application
// including user management and managing all people in all teams
// ------------------------------------------------------------------------------------------------------

class User extends Authenticatable
    // ---------------------------------------------------------------------------------------
    // class User extends Authenticatable implements MustVerifyEmail
    //
    // Ref : https://jetstream.laravel.com/features/registration.html#email-verification
    // ---------------------------------------------------------------------------------------
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'surname',

        'email',
        'email_verified_at',
        'password',

        'language',
        'timezone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
        'name',
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
            'is_developer' => 'boolean',
        ];
    }

    /* -------------------------------------------------------------------------------------------- */
    // Accessors & Mutators
    /* -------------------------------------------------------------------------------------------- */
    protected function getNameAttribute(): ?string
    {
        return implode(' ', array_filter([$this->firstname, $this->surname]));
    }

    public function hasPermission(string $permission): bool
    {
        return $this->hasTeamPermission($this->currentTeam, $permission);
    }

    public function hasRole(Role $role): bool
    {
        return $this->hasTeamRole($this->currentTeam, $role->value);
    }
//    public function CanP(Role $role): bool
//    {
//        return $this->hasTeamRole($this->currentTeam, $role->value);
//    }


    /* -------------------------------------------------------------------------------------------- */
    // Relations
    /* -------------------------------------------------------------------------------------------- */
    /* OK : returns ALL USERLOG (N USERLOG) */
    public function userlogs(): HasMany
    {
        return $this->hasMany(Userlog::class);
    }
}
