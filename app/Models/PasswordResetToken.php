<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    protected $table = 'password_reset_tokens';
    // biar gak ngedetek updated_at dan created_at
    public $timestamps = false;
    
    protected $primaryKey = 'email';
    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

}
