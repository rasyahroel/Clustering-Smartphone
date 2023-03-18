<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightInterpretasi extends Model
{
    use HasFactory;

    protected $tabel = 'right_interpretasis';
    protected $quarded = ['id'];
    // protected $with = ['students'];
    protected $fillable = [
        'right_id',
        'r_low',
        'r_high'
    ];

    public function right_audiograms()
    {
        return $this->belongsTo(RightAudiogram::class, 'right_id', 'id');
    }
}
