<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate(int $projectsOnPage)
 * @method static findOrFail(mixed $id)
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'comment', 'statusID', 'authorID'
    ];
}
