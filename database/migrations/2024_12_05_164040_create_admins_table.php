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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('admin_id', 30)->unique();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->date('dob');
            $table->string('image', 100)->default('default_user.png');
            $table->string('phone', 20);
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->text('address');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
