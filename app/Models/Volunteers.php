<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteers extends Model
{
    protected $fillable = [
        'name', 'volunteer_id', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday',
        'project_title', 'project_description', 'status',
    ];

    // Accessor for 'total' attribute
    public function getTotalAttribute()
    {
        $total = 0;
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            if ($this->{$day}) {
                $total += (int) $this->{$day};
            }
        }

        return $total;
    }
}
