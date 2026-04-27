<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('application_status_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
            $table->string('admin_notes')->nullable();
            $table->unsignedBigInteger('changed_by');
            $table->timestamp('changed_at');
            
            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('changed_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('application_status_history');
    }
};