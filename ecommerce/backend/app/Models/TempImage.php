<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TempImage extends Model
{
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image == "") {
            return "";
        }
        return asset('/uploads/temp/thumb/' . $this->image);
    }
}
