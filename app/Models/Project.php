<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'desc', 'img', 'status', 'views', 'publish_date'];

    //relasi ke Category
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function progresses()
{
    return $this->hasMany(Progress::class);
}

}
