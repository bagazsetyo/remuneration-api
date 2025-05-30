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
        Schema::create('employee_work_contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_record_id');
            $table->unsignedBigInteger('employee_id');
            $table->text('task_description');
            $table->decimal('hours_spent', 8,2)->default(0);
            $table->decimal('hourly_rate', 10,2);
            $table->date('date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_work_contributions');
    }
};
