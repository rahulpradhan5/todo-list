<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::dropIfExists('todos');
    }

    public function down()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->unsignedBigInteger('user_id');
            $table->boolean('completed_status')->default(0);
            $table->timestamps();
        });
    }
};
