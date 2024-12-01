<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_name');
            $table->date('dob');
            $table->string('phone')->nullable();
            $table->string('job_position'); // Added job_position field
            $table->string('address')->nullable(); // Address field
            $table->string('email')->unique(); // Email field
            $table->decimal('salary', 10, 2); // Salary field
            $table->boolean('status')->default(1); // Status field, defaults to active
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
