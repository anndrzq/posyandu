<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string("name");
            $table->string('place_of_birth_child');
            $table->date('date_of_birth_child');
            $table->string('gender');
            $table->enum('blood_type_child', ['-', 'A', 'B', 'AB', 'O']);
            $table->unsignedBigInteger('mother');
            $table->foreign('mother')->references('id')->on('families')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('children');
    }
};
