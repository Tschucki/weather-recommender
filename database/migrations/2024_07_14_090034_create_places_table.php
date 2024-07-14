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
            $table->string('title');
            $table->geography('location', subtype: 'point', srid: 4326);
            $table->double('elevation');
            $table->string('country_code');
            $table->integer('population');
            $table->string('country');
            $table->timestamps();

            $table->index('location', 'places_location_index');
            $table->unique(['title', 'location'], 'places_title_location_unique');
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
