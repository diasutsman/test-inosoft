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
            $collection->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $collection->string('name', 15);
            $collection->string('machine', 10);
            $collection->integer('passenger_capacity');
            $collection->string('type', 10);
            $collection->enum('status', ['ready', 'sold'])->default('ready');
            $collection->date('sold_at')->nullable();
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
