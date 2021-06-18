<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chefs', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('job')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('apply_date')->nullable();
            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('rating')->nullable();
            $table->string('status')->nullable();
            $table->json('notes')->nullable();
            $table->longText('candidate_overview')->nullable();
            $table->longText('resume')->nullable();
            $table->string('chef_type')->nullable();
            $table->integer('do_not_contact')->default(0);

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
        Schema::dropIfExists('chefs');
    }
}
