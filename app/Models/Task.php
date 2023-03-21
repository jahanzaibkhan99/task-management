<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $dates = [
        'due_date'
    ];

    protected $fillable = ['name', 'description', 'frequency', 'duration', 'due_date', 'status'];
    public $timestamps = true;

    public function group()
    {
        return $this->belongsToMany(TaskGroup::class);
    }

    public function scopePending($query)
    {
        return $query->where('due_date', '>=', today())->orderBy('due_date');
    }
}
