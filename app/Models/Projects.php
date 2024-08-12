<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteer_org_id', 'project_name', 'description', 'org_id',
    ];

    public function org()
    {
        return $this->belongsTo(Org::class, 'org_id');
    }

    public function volunteerOrg()
    {
        return $this->belongsTo(Volunteer_org::class, 'volunteer_org_id');
    }
}
