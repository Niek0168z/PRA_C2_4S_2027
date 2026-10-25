<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('manual_type', function (Blueprint $table) {
            $table->foreignId('manual_id')->constrained()->cascadeOnDelete();
            $table->foreignId('type_id')->constrained()->cascadeOnDelete();
            $table->primary(['manual_id', 'type_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manual_type');
        Schema::dropIfExists('types');
    }
};
