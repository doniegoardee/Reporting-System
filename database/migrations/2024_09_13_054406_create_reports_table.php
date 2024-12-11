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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('incident_type_id')->nullable();
            $table->string('subject_type');
            $table->string('location');
            $table->string('status');
            $table->text('description')->nullable();
            $table->text('name')->nullable();
            $table->string('email')->nullable();
            $table->text('contact')->nullable();
            $table->text('severity')->nullable();
            $table->text('num_affected')->nullable();
            $table->text('needs')->nullable();
            $table->string('image')->nullable();
            $table->string('responding_agency')->nullable();
            $table->string('resolved_time')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
