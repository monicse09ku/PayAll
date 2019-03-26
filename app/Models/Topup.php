<?php

namespace App\Models;

use App\Uuids;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use Uuids;
    protected $fillable = [
        'user_id', 'number', 'operator', 'amount', 'country', 'status', 'type', 'pradesh', 'provider', 'subscriber_id', 
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
