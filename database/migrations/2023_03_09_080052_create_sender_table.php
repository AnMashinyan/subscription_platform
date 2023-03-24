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
        Schema::create('senders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postId');
            $table->unsignedBigInteger('subscriberId');
            $table->foreign('postId')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('subscriberId')->references('id')->on('subscribers')->onDelete('cascade');
            $table->enum('isSend', ['0', '1']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senders');
    }
};
