<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        // Auto-add any missing columns on every boot (SQLite-safe, fast after first run)
        try {
            if (!Schema::hasTable('positions') || !Schema::hasTable('challans')) {
                return;
            }

            $posCols     = array_column(DB::select("PRAGMA table_info('positions')"), 'name');
            $challanCols = array_column(DB::select("PRAGMA table_info('challans')"), 'name');

            // Positions: new columns from advertisement
            if (!in_array('bps', $posCols))
                DB::statement("ALTER TABLE positions ADD COLUMN bps VARCHAR DEFAULT NULL");
            if (!in_array('vacancies', $posCols))
                DB::statement("ALTER TABLE positions ADD COLUMN vacancies INTEGER DEFAULT 0");
            if (!in_array('age_limit', $posCols))
                DB::statement("ALTER TABLE positions ADD COLUMN age_limit VARCHAR DEFAULT NULL");
            if (!in_array('qualification_required', $posCols))
                DB::statement("ALTER TABLE positions ADD COLUMN qualification_required VARCHAR DEFAULT NULL");
            if (!in_array('domicile', $posCols))
                DB::statement("ALTER TABLE positions ADD COLUMN domicile VARCHAR DEFAULT NULL");

            // Challans: fee verification columns
            if (!in_array('is_fee_verified', $challanCols))
                DB::statement("ALTER TABLE challans ADD COLUMN is_fee_verified INTEGER DEFAULT 0");
            if (!in_array('fee_verified_at', $challanCols))
                DB::statement("ALTER TABLE challans ADD COLUMN fee_verified_at DATETIME DEFAULT NULL");
            if (!in_array('fee_verified_by', $challanCols))
                DB::statement("ALTER TABLE challans ADD COLUMN fee_verified_by INTEGER DEFAULT NULL");

        } catch (\Exception $e) {
            // Tables may not exist yet (first-time setup) — silently skip
        }
    }
}
