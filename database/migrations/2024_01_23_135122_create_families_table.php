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
        Schema::create('families', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('mother_name');
            $table->date('date_of_birth_mom');
            $table->string('place_of_birth_mom');
            $table->enum('blood_type_mom', ['A', 'B', 'AB', 'O']);
            $table->string('father_name');
            $table->date('date_of_birth_father');
            $table->string('place_of_birth_father');
            $table->enum('blood_type_father', ['A', 'B', 'AB', 'O']);
            $table->integer('many_kids');
            $table->string('address');
            $table->string('city');
            $table->string('subdistrict');
            $table->string('ward');
            $table->string('postal_code');
            $table->string('phone_number')->unique();
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
        Schema::dropIfExists('families');
    }
};
