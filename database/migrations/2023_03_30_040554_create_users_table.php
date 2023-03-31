<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('uuid')->primary()->index();

            $table->string('name');
            $table->string('email')->unique();
            $table->string('cpf')->unique();

            $table->uuid('profile_uuid');

            $table->dateTime('created_at');
            $table->dateTime('updated_at');

            $table->foreign('profile_uuid')->references('uuid')->on('profiles');
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
