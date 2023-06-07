<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motors', function (Blueprint $collection) {
            $collection->id();
            $collection->foreignId('vehicle_id')->unique()->constrained()->onDelete('cascade');
            $collection->string('machine');
            $collection->string('suspension_type');
            $collection->string('transmission_type');
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
        Schema::dropIfExists('motors');
    }
}
