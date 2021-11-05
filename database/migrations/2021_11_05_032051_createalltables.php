<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Createalltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();
            $table->string('password');
            $table->string('permission');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('faces_array', function (Blueprint $table) {
            $table->id();
            $table->string('face_number');
            $table->integer('id_users');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->integer('name');
            $table->integer('id_owner');
            $table->integer('id_users_live');
        });

        Schema::create('unitspeoples', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit');
            $table->string('name');
            $table->integer('birthdate');
            $table->timestamps();
        });

        Schema::create('unitsvehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_units');
            $table->string('title');
            $table->string('color');
            $table->string('plate');
            $table->timestamps();
        });

        Schema::create('unitspets', function (Blueprint $table) {
            $table->id();
            $table->integer('id_units');
            $table->string('name');
            $table->string('race');
            $table->timestamps();
        });
        
        Schema::create('walls', function (Blueprint $table) {
            $table->id();
            $table->integer('id_users');
            $table->string('title');
            $table->string('body');
            $table->datetime('datetimecreated');
            $table->timestamps();
        });

        Schema::create('wallikes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_walls');
            $table->integer('id_users');
            $table->timestamps();
        });

        Schema::create('docs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('fileurl');
            $table->integer('id_users');
            $table->timestamps();
        });

        Schema::create('billets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('fileurl');
            $table->integer('id_units');
            $table->integer('id_users');
            $table->timestamps();
        });

        Schema::create('warnings', function (Blueprint $table) {
            $table->id();
            $table->integer('id_units');
            $table->string('title');
            $table->string('description');
            $table->string('status')->default('IN_REVIEW');
            $table->string('photos');
            $table->datetime('datecreated');
            $table->timestamps();
        });

        Schema::create('found_and_lost', function (Blueprint $table) {
            $table->id();
            $table->string('status')->default('LOST');
            $table->string('photo');
            $table->integer('descripction');
            $table->integer('where_found');
            $table->integer('user_lost');
            $table->integer('user_found');
            $table->date('datecreated');
            $table->timestamps();
        });

        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->integer('allowed')->default(1);
            $table->string('title');
            $table->string('cover');
            $table->string('days');
            $table->timestamps();
        });

        Schema::create('areasdisabledays', function (Blueprint $table) {
            $table->id();
            $table->integer('id_area')->default(1);
            $table->date('day');
            $table->timestamps();
        });

        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('id_units')->default(1);
            $table->datetime('reservation_date_start');
            $table->datetime('reservation_date_finish');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('faces_array');
        Schema::dropIfExists('units');
        Schema::dropIfExists('unitspeoples');
        Schema::dropIfExists('unitsvehicles');
        Schema::dropIfExists('unitspets');
        Schema::dropIfExists('walls');
        Schema::dropIfExists('wallikes');
        Schema::dropIfExists('docs');
        Schema::dropIfExists('billets');
        Schema::dropIfExists('warnings');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('found_and_lost');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('areasdisabledays');
        Schema::dropIfExists('reservations');
        
        

    }
}
