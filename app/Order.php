<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Order extends Model
{



    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            // $item->{$item->getKeyName()} = (string) Str::uuid();

            $item->uuid = (string) Str::uuid();


        });
    }



    public function preorder()
    {
        return $this->belongsTo(PreOrder::class, 'preorder_id');
    }

}
