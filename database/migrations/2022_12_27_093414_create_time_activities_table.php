<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users');
            $table->foreignId('projectId')->constrained('projects');
            $table->foreignId('todoId')->constrained('todos');
            $table->time('time_spent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_activities');
    }
};
