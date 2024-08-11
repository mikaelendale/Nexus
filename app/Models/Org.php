<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use HasFactory;
    protected $table = 'org';
    protected $fillable = [ 'name', ];
    public function volunteers()
    {
        return $this->belongsToMany(Volunteers::class, 'volunteer_org', 'org_id', 'volunteers_id');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class, 'org_id');
    }
}
