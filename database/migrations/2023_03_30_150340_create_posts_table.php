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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();            
            $table->string('title')->unique();
            $table->text('content');
            $table->string('cover_image')->nullable();
            $table->integer('user_id');
            $table->integer('category_id');
            $table->integer('likes')->default(0);
            $table->integer('shares')->default(0);
            $table->boolean('status')->default(0);            
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
        Schema::dropIfExists('posts');
    }
};
