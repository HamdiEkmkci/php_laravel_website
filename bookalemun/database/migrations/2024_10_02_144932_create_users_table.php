<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name', 20)->unique();
            $table->string('user_fname', 20)->nullable();
            $table->string('user_lname', 20)->nullable();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('profile_image')->nullable();
            $table->string('favourite_aut', 30)->nullable();
            $table->string('favourite_book', 20)->nullable();
            $table->integer('fb_page_count')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
