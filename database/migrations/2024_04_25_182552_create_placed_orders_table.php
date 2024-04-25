<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacedOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('placed_orders', function (Blueprint $table) {
            $table->id();
            $table->string('receiver_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->enum('payment_method', ['Cash on Delivery', 'Card']);
            $table->string('name_on_card')->nullable();
            $table->string('card_number')->nullable();
            $table->string('card_exp_date', 5)->nullable();
            $table->string('cvv', 4)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('product_id');
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    public function down()
    {
        Schema::dropIfExists('placed_orders');
    }
}
