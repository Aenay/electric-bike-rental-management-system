<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id(); // bike_id
            $table->string('model');
            $table->string('status')->default('available');
            $table->foreignId('station_id')->nullable()->constrained('stations')->nullOnDelete(); // location_id
            $table->unsignedTinyInteger('battery_level')->default(100);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};


