<?php

declare(strict_types = 1);

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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('registration_plate');
            $table->timestamp('time_entered');
            $table->timestamp('time_exited')->nullable();
            $table->string('category');
            $table->string('color');
            $table->string('brand');
            $table->string('model');
            $table->foreignId('card_id')->nullable();
            $table->decimal('sum_paid', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }

};
