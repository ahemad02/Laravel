<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function mcqs()
    {
        return $this->hasMany(Mcq::class);
    }
}
