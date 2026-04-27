<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('challans', function (Blueprint $table) {
            $table->id();
            $table->string('challan_no', 20)->unique();
            $table->foreignId('application_id')->constrained()->onDelete('cascade');
            $table->decimal('fee_amount', 8, 2)->default(300.00);
            $table->decimal('bank_charges', 8, 2)->default(0.00);
            $table->decimal('total_amount', 8, 2)->default(300.00);
            $table->timestamp('generated_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('challans');
    }
};