<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableMedias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medias', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedTinyInteger('type')->default(1)->comment('1: image; 2: video');
            $table->text('video')->nullable()->default(null);
            $table->string('mediable_type');
            $table->unsignedBigInteger('mediable_id');
            $table->unsignedTinyInteger('default')->default(0);
            $table->string('caption')->nullable()->default(null);
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
        Schema::dropIfExists('medias');
    }
}
