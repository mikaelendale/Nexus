<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteers extends Model
{
    // Specify the table name for this model
    use HasFactory;
    protected $table = 'volunteers';
    protected $fillable = [
        'name', 'volunteer_id', 
    ]; 
    public function orgs()
    {
        return $this->belongsToMany(Org::class, 'volunteer_org', 'volunteer_id', 'org_id');
    }

    public function projects()
    {
        return $this->hasMany(Projects::class, 'volunteer_id');
    }
}
