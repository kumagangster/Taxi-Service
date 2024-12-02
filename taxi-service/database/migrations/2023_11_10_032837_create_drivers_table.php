<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name');
            $table->string('driver_email')->unique();
            $table->bigInteger('driver_phone')->unique();
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('inactive');
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
