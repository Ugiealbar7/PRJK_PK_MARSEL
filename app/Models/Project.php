<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'desc',
        'img',
        'publish_date',
        'status',
        'category_id',
        'views'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Tambahkan relasi ini
   public function progresses()
{
    return $this->hasMany(Progress::class);
}

}
