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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('admission_number')->unique();
            $table->string('class');
            $table->string('section');
            $table->string('roll_number');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('parent_name');
            $table->string('parent_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
