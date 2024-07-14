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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('hash', 32)->unique();
            $table->string('name');
            $table->geography('location', subtype: 'point', srid: 4326);
            $table->double('elevation')->nullable();
            $table->string('country_code');
            $table->integer('population')->nullable();
            $table->string('country');
            $table->string('timezone');
            $table->string('flag');
            $table->timestamps();

            $table->index('location', 'places_location_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
