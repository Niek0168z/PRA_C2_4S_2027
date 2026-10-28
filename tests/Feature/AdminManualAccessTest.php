<?php

namespace Tests\Feature;

use App\Models\Manual;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class AdminManualAccessTest extends TestCase
{
    public function test_manual_form_is_available_to_guests(): void
    {
        $this->get(route('admin.manuals.create'))
            ->assertOk()
            ->assertSee('Handleiding toevoegen');

        $this->post(route('admin.manuals.store'))
            ->assertSessionHasErrors(['brand_id', 'type_id', 'type_name', 'name', 'filesize', 'originUrl']);
    }

    public function test_login_page_is_available_to_guests(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('Inloggen');
    }

    public function test_manual_can_be_added_with_a_new_type(): void
    {
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        $this->artisan('migrate:fresh')->assertExitCode(0);

        $brandId = DB::table('brands')->insertGetId([
            'name' => 'Test brand',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->post(route('admin.manuals.store'), [
            'brand_id' => $brandId,
            'type_name' => 'Test type',
            'name' => 'Test model',
            'filesize' => 1024,
            'originUrl' => 'https://example.com/manual.pdf',
        ])
            ->assertRedirect(route('admin.manuals.create'))
            ->assertSessionHas('status', 'De handleiding is toegevoegd.');

        $manual = Manual::with('types')->firstOrFail();
        $this->assertSame('Test model', $manual->name);
        $this->assertSame('Test type', $manual->types->sole()->name);
        $this->assertSame($brandId, $manual->types->sole()->brand_id);
    }

    public function test_existing_manuals_are_available_as_types_for_their_brand(): void
    {
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
        ]);
        DB::purge('sqlite');
        $this->artisan('migrate:fresh')->assertExitCode(0);

        $brandId = DB::table('brands')->insertGetId([
            'name' => 'Test brand',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('manuals')->insert([
            'brand_id' => $brandId,
            'name' => 'Existing model',
            'filesize' => 1024,
            'originUrl' => 'https://example.com/manual.pdf',
            'counter' => 0,
            'testcolumn' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $migration = require database_path('migrations/2026_10_28_000001_backfill_types_from_existing_manuals.php');
        $migration->up();

        $this->get(route('admin.manuals.create'))
            ->assertOk()
            ->assertSee('Test brand - Existing model');
    }
}
