<?php

use App\Models\VoteUnit;
use App\Models\Voting;
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
        Schema::create('vote_items', function (Blueprint $table) {
            $table->id();
            // $table->foreignIdFor(Voting::class,'vote_id');
            $table->foreignIdFor(VoteUnit::class,'vote_unit_id');
            $table->integer('response')->nullable();
            $table->string('vote_image');
            $table->string('vote_name');
            $table->string('slug')->nullable();
            $table->string('vote_position')->nullable();
            $table->text('short_desc')->nullable();
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
        Schema::dropIfExists('vote_items');
    }
};
