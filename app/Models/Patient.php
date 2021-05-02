<?php

namespace App\Models;

use App\Models\Admin\Disease;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function disease()
    {
        return $this->belongsTo(Disease::class);
    }
}
