<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Uuids;

class Fund extends Model
{
    use Uuids;
    protected $fillable = [
        'user_id', 'bal_mr', 'bal_mm', 'ind_rp', 'npl_rp'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
