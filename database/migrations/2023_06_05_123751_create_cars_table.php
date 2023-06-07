<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('vehicle_id')->unique()->constrained()->onDelete('cascade');
            $collection->string('machine');
            $collection->integer('passenger_capacity');
            $collection->string('type');
            $collection->enum('status', ['ready', 'sold'])->default('ready');
            $collection->date('sold_date')->nullable();
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
