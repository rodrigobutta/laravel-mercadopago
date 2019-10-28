<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Order extends Model
{

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           
            $model->{$model->getKeyName()} = (string) Str::uuid();


        });
    }



    public function preorder()
    {
        return $this->belongsTo(PreOrder::class, 'preorder_id');
    }

}
