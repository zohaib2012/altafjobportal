<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_id', 20)->unique();
            $table->string('full_name', 200);
            $table->string('father_name', 200);
            $table->string('cnic', 15)->unique();
            $table->date('date_of_birth');
            $table->string('mobile', 15);
            $table->string('email', 200);
            $table->text('address');
            $table->string('qualification', 200);
            $table->foreignId('position_id')->constrained()->onDelete('cascade');
            $table->string('status', 20)->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};