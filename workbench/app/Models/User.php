<?php

namespace Workbench\App\Models;

use Batv45\Balance\HasBalance;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    use HasBalance;

    protected $casts = [
        'balance' => 'integer'
    ];
}
