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
        Schema::table('users', function (Blueprint $table)
        {
            $table->string('lastname');
            $table->string('phone');
            $table->string('street');
            $table->string('number');
            $table->string('apartment');
            $table->string('city');
            $table->string('postcode');
            $table->date('birthdate')->default('1000-01-01');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns(
            'users',
            [
                'lastname',
                'phone',
                'street',
                'number',
                'apartment',
                'city',
                'postcode',
                'birthdate'
            ]
        );
    }
};
