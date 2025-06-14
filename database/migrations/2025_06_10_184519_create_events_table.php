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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->required();
            $table->text('description');
            $table->date('date_register_start')->nullable();
            $table->date('date_register_end')->required();
            $table->date('date_submission')->required();
            $table->date('date_evaluate_start')->nullable();
            $table->date('date_evaluate_end')->required();
            $table->date('date_announcement')->required();
            $table->date('date_ceremony')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
