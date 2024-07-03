<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo_list extends Model
{
    use HasFactory;
    protected $table = 'todos';
    protected $fillable = ['task', 'user_id', 'completed_status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
