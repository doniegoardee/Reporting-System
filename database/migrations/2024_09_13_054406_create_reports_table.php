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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('subject_type');
            $table->string('location');
            $table->string('status');
            $table->text('description');
            $table->text('name');
            $table->string('email')->unique();
            $table->text('user_id');
            $table->text('severity');
            $table->text('num_affected');
            $table->text('needs');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
