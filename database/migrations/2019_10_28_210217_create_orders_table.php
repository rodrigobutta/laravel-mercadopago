<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->timestamps();

            $table->integer('preorder_id')->unsigned();
            $table->integer('total_price')->unsigned();
            $table->string('title')->nullable();
            $table->string('featured_img')->nullable();
            $table->boolean('paid')->default(0);
            $table->dateTime('paid_at')->nullable();

            $table->primary('id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
