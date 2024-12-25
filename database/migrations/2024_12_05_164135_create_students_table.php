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
            $table->string('student_id', 40)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('father_name', 200);
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('class', 50);
            $table->string('section', 50);
            $table->date('dob');
            $table->string('image', 100)->default('default_user.png');
            $table->string('phone', 20);
            $table->string('email', 100)->unique();
            $table->text('address');
            $table->string('city', 50);
            $table->string('zip', 20);
            $table->string('state', 50);
            $table->timestamps();
            $table->softDeletes();
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
