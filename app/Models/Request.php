<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail(mixed $id)
 * @method static paginate($billsOnPage)
 * @method static where(string $string, int $projectID)
 */
class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'projectID'
    ];

    public function goods() {
        $this->hasMany(RequestGood::class, 'requestID', 'id');
    }
}
