<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Images extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "objek_images";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'objek_id',
        'images',
    ];

    public function getImagesAttribute($images){
        // return config('app.url').Storage::url($images);
        return asset('storage/' . $images);
    }   
}
