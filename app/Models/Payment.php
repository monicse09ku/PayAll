<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class Payment extends Model
{
	use Uuids;
    protected $fillable = [
        'user_id', 'fund_type', 'status', 'amount', 'type', 'description', 'from_user', 'to_user', 'transaction_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
