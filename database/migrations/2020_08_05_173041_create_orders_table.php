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
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')
                  ->onUpdate('cascade')->onDelete('set null');
            // Billing address
            $table->string('billing_email')->nullable();
            $table->string('billing_firstName')->nullable();
            $table->string('billing_lastName')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('billing_city')->nullable();
            $table->string('billing_province')->nullable();
            $table->string('billing_postalcode')->nullable();
            $table->string('billing_phone')->nullable();

            // Delivery addreess
            $table->string('delivery_email')->nullable();
            $table->string('delivery_firstName')->nullable();
            $table->string('delivery_lastName')->nullable();
            $table->string('delivery_country')->nullable();
            $table->string('delivery_address')->nullable();
            $table->string('delivery_city')->nullable();
            $table->string('delivery_province')->nullable();
            $table->string('delivery_postalcode')->nullable();
            $table->string('delivery_phone')->nullable();

            $table->string('name_on_card')->nullable();
            $table->integer('discount')->default(0);
            $table->string('discount_code')->nullable();
            $table->integer('subtotal');
            $table->integer('tax');
            $table->integer('total');
            $table->string('payment_gateway')->default('stripe');
            $table->string('shipped')->default('No');
            $table->string('error')->nullable();
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
