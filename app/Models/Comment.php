<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Comment extends Model
{
    use Notifiable;

    protected $fillable = [
        "text", "create_at", "user_id", "parent_id", "edit_check"
    ];

    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('H:i d-m-Y');
    }
}
