<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArrivalLog extends Model
{
    use HasFactory;

    protected $fillable = ['item_id','quantity', 'type'];
    
    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
