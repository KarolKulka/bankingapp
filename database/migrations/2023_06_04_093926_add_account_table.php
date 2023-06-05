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
        Schema::create('accounts', function (Blueprint $table){
           $table->uuid('id');
           $table->string('name');
           $table->string('number', 26)->unique();
           $table->double('balance', 8, 2)->default(0);
           $table->foreignId('user_id');
           $table->index('user_id');
           $table->index('id');
           $table->index('number');
           $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
