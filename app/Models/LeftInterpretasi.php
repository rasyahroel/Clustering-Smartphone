<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftInterpretasi extends Model
{
    use HasFactory;

    protected $tabel = 'left_interpretasis';
    protected $quarded = ['id'];
    // protected $with = ['students'];
    protected $fillable = [
        'left_id',
        'l_low',
        'l_high'
    ];

    public function left_audiograms()
    {
        return $this->belongsTo(LeftAudiogram::class, 'left_id', 'id');
    }
}
