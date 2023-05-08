<?php

namespace App\Models;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code'
    ];

    public function medicines(): HasMany
    {
        return $this->hasMany(Medicine::class);
    }
}
