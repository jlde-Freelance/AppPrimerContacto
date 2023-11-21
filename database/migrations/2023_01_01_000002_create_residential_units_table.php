<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('residential_units', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 200)->nullable();
            $table->string('year_built', 10)->nullable();
            $table->foreignId('stratum_id')->nullable()->references('id')->on('master_options');
            $table->json('specifications')->nullable();
            $table->boolean('status')->default(1);
            $table->foreignId('created_by')->nullable()->references('id')->on('users');
            $table->foreignId('updated_by')->nullable()->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('residential_units');
    }
};
