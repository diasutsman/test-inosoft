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
            $collection->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $collection->string('name', 15);
            $collection->string('machine', 10);
            $collection->string('suspension_type', 20);
            $collection->string('transmission_type', 10);
            $collection->enum('type', ['ready', 'sold'])->default('ready');
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
        Schema::dropIfExists('motors');
    }
}
