<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, int $billID)
 * @method static findOrFail(mixed $id)
 */
class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'projectID', 'billID', 'sumVal', 'payDate', 'statusID'
    ];
}
