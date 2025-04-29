<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    public function header(): BelongsTo
    {
        return $this->belongsTo(OrderHeader::class, 'header_id', 'id');
    }
}
