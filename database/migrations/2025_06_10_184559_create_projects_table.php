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
        Schema::create('projects', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('title');
            $table->string('abstract');
            $table->string('leader');
            $table->string('organisation');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('member1');
            $table->string('member2')->nullable();
            $table->string('member3')->nullable();
            $table->string('member4')->nullable();
            $table->string('publication')->nullable();
            $table->string('technical_paper')->nullable();
            $table->string('link')->nullable();
            $table->string('award')->nullable();
            $table->string('receipt')->nullable();
            $table->string('status')->default('DRAFT');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('event_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('event_id')->references('id')->on('events');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
