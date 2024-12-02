<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('film_name');
            $table->string('image_name')->nullable(); // Optional, to store the image's name
            $table->string('mime_type')->nullable(); // To store the image's mime type (e.g., image/jpeg)
            $table->binary('image_data')->nullable(); 
            $table->bigInteger('account_id')->unsigned()->dropUnique();

            $table->foreign('account_id')->references('id')->on('accounts')
            ->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
