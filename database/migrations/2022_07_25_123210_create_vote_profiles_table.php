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
        Schema::create('vote_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('vote_item_id');
            $table->string('icon');
            $table->string('title');
            $table->text('description');
            $table->longText('gallery');
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
        Schema::dropIfExists('vote_profiles');
    }
};
