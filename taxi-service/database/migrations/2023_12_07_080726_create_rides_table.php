<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->string('start_location');
            $table->double('start_latitude', 10, 6);
            $table->double('start_longitude', 10, 6);
            $table->string('destination_location');
            $table->double('destination_latitude', 10, 6);
            $table->double('destination_longitude', 10, 6);
            $table->enum('status', ['pending', 'confirmed', 'started', 'completed'])->default('pending');
            $table->timestamp('requested_time')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->timestamps();
//            $table->bigInteger('fare');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade'); // Assuming 'customers' is the name of your customers table
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
