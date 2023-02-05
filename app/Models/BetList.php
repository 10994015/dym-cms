<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BetList extends Model
{
    use HasFactory;
    protected $table = "betlist";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
