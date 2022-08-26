<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Objek extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "objek";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
        'deskripsi',
        'ltd',
        'lngtd',
        'kategori_id'
    ];

    

    // objek -> images (one to many)
    public function images(){
        return $this->hasMany(Images::class, 'objek_id', 'id');
    }

    // objek -> kategori (one to one)
    public function category(){
        return$this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
}
