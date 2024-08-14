<?php

// Projects.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;

    protected $fillable = [
        'volunteers_id', 'project_name', 'description', 'org_id', 'volunteer_org_id',
    ];

   public function org()
    {
        return $this->belongsTo(Org::class, 'org_id');
    }
    public function volunteer()
    {
        return $this->belongsTo(Volunteers::class, 'volunteers_id');
    }

    public function volunteerOrg()
{
    return $this->belongsTo(Volunteer_org::class, 'volunteers_id');
}

}

