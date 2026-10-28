<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('manuals')
            ->orderBy('id')
            ->chunk(500, function ($manuals) {
                foreach ($manuals as $manual) {
                    $typeId = DB::table('types')
                        ->where('brand_id', $manual->brand_id)
                        ->where('name', $manual->name)
                        ->value('id');

                    if ($typeId === null) {
                        $typeId = DB::table('types')->insertGetId([
                            'brand_id' => $manual->brand_id,
                            'name' => $manual->name,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    DB::table('manual_type')->insertOrIgnore([
                        'manual_id' => $manual->id,
                        'type_id' => $typeId,
                    ]);
                }
            });
    }

    public function down(): void
    {
        // Existing manual/type assignments may be in use, so this data migration is intentionally irreversible.
    }
};
