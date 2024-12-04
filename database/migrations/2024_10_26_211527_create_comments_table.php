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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->bigInteger('account_id')->unsigned()->dropUnique();
            $table->bigInteger('post_id')->nullable()->unsigned()->dropUnique();
            $table->foreignId('parent_comment_id')->nullable()->dropUnique();
            
            $table->foreign('parent_comment_id')->references('id')->on('comments')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->foreign('post_id')->references('id')->on('posts')
            ->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('comments');
    }
};
