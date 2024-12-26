<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_from');
            $table->unsignedBigInteger('message_to');
            $table->text('message_content');
            $table->timestamps();

            $table->foreign('message_from')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('message_to')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
