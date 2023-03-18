<?php

namespace App\Models;

use App\Models\LeftInterpretasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeftAudiogram extends Model
{
    // use HasFactory;

    protected $tabel = 'left_audiograms';
    protected $quarded = ['id'];
    // protected $with = ['students'];
    protected $fillable = [
        'student_id',
        'l_500',
        'l_1000',
        'l_2000',
        'l_3000',
        'l_4000',
        'l_6000'
    ];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function left_interpretasis()
    {
        return $this->hasOne(LeftInterpretasi::class, 'left_id', 'id');
    }
}
