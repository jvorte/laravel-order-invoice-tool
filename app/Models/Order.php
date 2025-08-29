<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
class Order extends Model
{   
       use HasFactory;

    protected $fillable = ['customer_id','status','total'];
    
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
