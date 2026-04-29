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
        Schema::table('positions', function (Blueprint $table) {
            if (!Schema::hasColumn('positions', 'bps')) {
                $table->string('bps', 100)->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('positions', 'vacancies')) {
                $table->integer('vacancies')->default(0)->after('bps');
            }
            if (!Schema::hasColumn('positions', 'age_limit')) {
                $table->string('age_limit', 50)->nullable()->after('vacancies');
            }
            if (!Schema::hasColumn('positions', 'qualification_required')) {
                $table->string('qualification_required', 200)->nullable()->after('age_limit');
            }
            if (!Schema::hasColumn('positions', 'domicile')) {
                $table->string('domicile', 200)->nullable()->after('qualification_required');
            }
        });
    }

    public function down(): void
    {
        Schema::table('positions', function (Blueprint $table) {
            $table->dropColumn(['bps', 'vacancies', 'age_limit', 'qualification_required', 'domicile']);
        });
    }
};
