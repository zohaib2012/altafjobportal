<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        try {
            if (!Schema::hasTable('positions') || !Schema::hasTable('challans')) {
                return;
            }

            // Positions: new columns
            if (!Schema::hasColumn('positions', 'bps'))
                Schema::table('positions', fn($t) => $t->string('bps')->nullable());
            if (!Schema::hasColumn('positions', 'vacancies'))
                Schema::table('positions', fn($t) => $t->integer('vacancies')->default(0));
            if (!Schema::hasColumn('positions', 'age_limit'))
                Schema::table('positions', fn($t) => $t->string('age_limit')->nullable());
            if (!Schema::hasColumn('positions', 'qualification_required'))
                Schema::table('positions', fn($t) => $t->string('qualification_required')->nullable());
            if (!Schema::hasColumn('positions', 'domicile'))
                Schema::table('positions', fn($t) => $t->string('domicile')->nullable());

            // Challans: fee verification columns
            if (!Schema::hasColumn('challans', 'is_fee_verified'))
                Schema::table('challans', fn($t) => $t->boolean('is_fee_verified')->default(false));
            if (!Schema::hasColumn('challans', 'fee_verified_at'))
                Schema::table('challans', fn($t) => $t->dateTime('fee_verified_at')->nullable());
            if (!Schema::hasColumn('challans', 'fee_verified_by'))
                Schema::table('challans', fn($t) => $t->integer('fee_verified_by')->nullable());

        } catch (\Exception $e) {
            // silently skip if tables don't exist yet
        }
    }
}
