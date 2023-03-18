<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    // protected $primaryKey = 'id_student';
    // public $timestamps = false;
    protected $table = 'students';
    protected $quarded = ['id'];
    protected $with = ['category','user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn($query) =>
                $query->where('slug', $category)
            )
        );
        
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('name' , 'like' , '%' . $search . '%')
                        ->orWhere('class' , 'like' , '%' . $search . '%');
        });

        

        $query->when($filters['user'] ?? false, fn($query, $user) =>
            $query->whereHas('user', fn($query) =>
                $query->where('username', $user)
            )
        );
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function left_audiogram()
    {
        return $this->hasOne(LeftAudiogram::class);
    }

    public function left_interpretasi()
    {
        return $this->hasOneThrough(LeftInterpretasi::class, LeftAudiogram::class, 'id', 'left_id');
    }

    public function right_audiogram()
    {
        return $this->hasOne(RightAudiogram::class);
    }

    public function right_interpretasi()
    {
        return $this->hasOneThrough(RightInterpretasi::class, RightAudiogram::class, 'id', 'right_id');
    }
}
