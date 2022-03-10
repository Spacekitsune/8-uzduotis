<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public function taskOwner() {
        return $this->belongsTo(Owner::class, 'owner_id', 'id');
    }
}
