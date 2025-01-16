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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->text('user_info')->nullable();
            $table->timestamp('born_at')->nullable();
            $table->integer('address_id')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('instagram_url')->nullable();
            $table->json('professions')->nullable();
            $table->json('images')->nullable();
            $table->text('captured_image')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->tinyInteger('is_admin')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
