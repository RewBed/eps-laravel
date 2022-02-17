<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(mixed $id)
 * @method static paginate($projectsOnPage)
 * @method static where(string $string, int $projectID)
 */
class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'projectID'
    ];
}
