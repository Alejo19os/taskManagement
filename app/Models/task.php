<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Task
 *
 * @property $id
 * @property $user_id
 * @property $title
 * @property $description
 * @property $due_date
 * @property $completed
 * @property $created_at
 * @property $updated_at
 *
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Task extends Model
{
    
    protected $perPage = 20;

    use HasFactory;
    protected $fillable = ['user_id', 'title', 'description', 'due_date', 'completed'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id', 'id');
    }
    
}
