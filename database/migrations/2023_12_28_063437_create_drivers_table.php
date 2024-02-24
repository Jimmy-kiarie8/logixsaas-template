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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->uniqid();
            $table->string('email')->uniqid();
            $table->string('phone_number')->uniqid();
            $table->string('license_number')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_registration_number')->nullable();
            $table->boolean('availability_status')->default(false);
            $table->boolean('active')->default(true);
            $table->string('current_location')->nullable();
            $table->string('type')->nullable();
            $table->decimal('ratings')->default(0);
            $table->unsignedBigInteger('driver_group_id')->nullable();

            $table->foreign('driver_group_id')->references('id')->on('driver_groups')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
