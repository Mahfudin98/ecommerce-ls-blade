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
            $table->id();
            $table->string('invoice')->unique();
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->unsignedBigInteger('district_id');
            $table->integer('subtotal');
            $table->integer('cost')->default(0);
            $table->string('shipping')->nullable();
            $table->char('status', 1)->default(0)->comment('0: new, 1: confirm, 2: process, 3: shipping, 4: done');
            $table->string('tracking_number')->nullable();
            $table->string('ref')->nullable();
            $table->boolean('ref_status')->default(false);
            $table->timestamps();
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
