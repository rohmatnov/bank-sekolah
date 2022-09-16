<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'account_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $appends = ['initial'];

    public function getInitialAttribute()
    {
        $collection = str()->of($this->attributes['name'])->explode(' ');

        if ($collection->count() < 2) {
            return str()->of($this->attributes['name'])->substr(0, 2)->upper()->toString();
        }

        $first = str()->of($collection->first())->substr(0, 1)->upper();
        $last = str()->of($collection->last())->substr(0, 1)->upper();

        return $first . $last;
    }
}
