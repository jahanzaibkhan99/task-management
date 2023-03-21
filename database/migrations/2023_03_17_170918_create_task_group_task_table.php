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
        Schema::create('task_task_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_group_id');
            $table->unsignedBigInteger('task_id');
            $table->timestamps();

            $table->foreign('task_group_id')->references('id')->on('task_groups')->onDelete('cascade');
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_task_group');
    }
};
