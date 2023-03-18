<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightAudiogram extends Model
{
    use HasFactory;

    protected $tabel = 'right_audiograms';
    protected $quarded = ['id'];
    protected $fillable = [
        'student_id',
        'r_500',
        'r_1000',
        'r_2000',
        'r_3000',
        'r_4000',
        'r_6000'
    ];

    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function right_interpretasis()
    {
        return $this->hasOne(RightInterpretasi::class, 'right_id', 'id');
    }
}
