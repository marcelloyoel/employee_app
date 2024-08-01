<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string'; // Use 'string' because user_id is a string
    public $timestamps = true; // Adjust if you have timestamps
    protected $fillable = ['user_id', 'name', 'email', 'email_verified_at', 'status'];
}
