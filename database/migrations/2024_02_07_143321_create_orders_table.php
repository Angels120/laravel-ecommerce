<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->double('subtotal',10,2);
            $table->double('shipping',10,2);
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_code_id')->nullable();
            $table->double('discount',10,2)->nullable();
            $table->double('grand_total',10,2);
            $table->enum('payment_status',['paid','not_paid'])->default('not_paid');
            $table->enum('status',['pending','shipped','delivered'])->default('pending');


            //User Address related columns
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade');
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
