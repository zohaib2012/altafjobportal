<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->string('cv_path', 500)->nullable();
            $table->string('cv_original_name', 200)->nullable();
            $table->integer('cv_size')->nullable();
            $table->timestamp('cv_uploaded_at')->nullable();
            $table->string('challan_path', 500)->nullable();
            $table->string('challan_original_name', 200)->nullable();
            $table->integer('challan_size')->nullable();
            $table->timestamp('challan_uploaded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};