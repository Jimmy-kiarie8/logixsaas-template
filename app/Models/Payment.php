<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ["payment_date", "payment_mode", "item", "amount_paid", "payment_code", "sale_id", "client_id", "invoice_id"];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
