<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "kategori";

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nama',
    ];

    // kategori -> objek (one to many)
    public function objects(){
        return $this->hasMany(Objek::class, 'kategori_id', 'id');
    }
}
