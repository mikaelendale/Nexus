<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer_org extends Model
{
    use HasFactory;
    protected $table = 'volunteer_org';
    protected $fillable = [
        'volunteer_id', 'org_id', 'hours',
    ];
    
    public function volunteer()
    {
        return $this->belongsTo(Volunteers::class, 'volunteer_id');
    }

    public function org()
    {
        return $this->belongsTo(Org::class, 'org_id');
    }
}
