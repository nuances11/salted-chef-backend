<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chef extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job',
        'city',
        'state',
        'apply_date',
        'name',
        'email',
        'phone_number',
        'rating',
        'status',
        'notes',
        'labels',
        'candidate_overview',
        'resume',
        'chef_type',
        'zipcode',
        'do_not_contact',
    ];
}
