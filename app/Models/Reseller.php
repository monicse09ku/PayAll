<?php

namespace App\Models;
use App\Uuids;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
	use Uuids;
    protected $fillable = [
        'user_id', 'parent_user', 'pin'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
