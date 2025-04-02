<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupInvite extends Model
{
    /** @use HasFactory<\Database\Factories\GroupInviteFactory> */
    use HasFactory;
    protected $fillable = [
        'group_id',
        'from_user_id',
        'to_user_id',
        'type',
    ];
}
