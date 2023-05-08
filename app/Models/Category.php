<?php

namespace App\Models;

use App\Models\Medicine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code'
    ];

    public function medicines(): BelongsToMany
    {
        return $this->belongsToMany(Medicine::class);
    }
}
