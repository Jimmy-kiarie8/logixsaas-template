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
        Schema::create('sales', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->nullable();
            $table->string('status')->nullable();
            $table->string('amount')->nullable();
            $table->string('product_name')->nullable();
            $table->string('delivery_status')->nullable();
            $table->dateTime('delivery_date')->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('shipping_charges')->default(0);

            $table->boolean('pickup_delayed')->default(0);
            $table->boolean('delivery_delayed')->default(0);
            $table->boolean('door_delivery')->default(0);
            $table->boolean('paid')->default(0);


            $table->decimal('weight')->default(0);
            $table->decimal('distance')->default(0);

            $table->dateTime('cancelled_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->dateTime('dispatched_at')->nullable();
            $table->dateTime('assigned_at')->nullable();

            $table->dateTime('pickedup_at')->nullable();
            $table->dateTime('deliverup_at')->nullable();
            $table->dateTime('pickup_before')->nullable();
            $table->dateTime('deliver_before')->nullable();
            $table->text('notes')->nullable();
            $table->text('returned_notes')->nullable();
            $table->text('cancelled_notes')->nullable();
            $table->string('pickup_image')->nullable();
            $table->string('delivery_image')->nullable();
            $table->string('channel')->nullable();

            $table->unsignedBigInteger('sender_id')->nullable();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            $table->foreign('receiver_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('sender_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
