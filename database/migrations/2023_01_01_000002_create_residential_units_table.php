<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_RESIDENTIAL_UNITS')) define('TABLE_RESIDENTIAL_UNITS', 'residential_units');

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create(TABLE_RESIDENTIAL_UNITS, function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 200)->nullable();
            $table->string('year_built', 10)->nullable();
            $table->foreignId('stratum_id')->nullable()->references('id')->on(TABLE_MASTER_OPTIONS);
            $table->json('specifications')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('created_by')->nullable()->references('id')->on(TABLE_USER);
            $table->foreignId('updated_by')->nullable()->references('id')->on(TABLE_USER);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_RESIDENTIAL_UNITS);
        Schema::enableForeignKeyConstraints();
    }
};
