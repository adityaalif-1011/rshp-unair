<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Mapping ke tabel "role"
    protected $table = 'role';
    protected $primaryKey = 'idrole';
    public $timestamps = false; // kalau memang tidak ada created_at/updated_at
public $incrementing = true;
protected $keyType = 'int';

    protected $fillable = ['nama_role'];

    // Relasi ke User (via pivot role_user)
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user', 'idrole', 'iduser')
                    ->withPivot('status', 'idrole_user');
    }
}
