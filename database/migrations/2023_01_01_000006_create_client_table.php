<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_CLIENTS')) define('TABLE_CLIENTS', 'clients');

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create(TABLE_CLIENTS, function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 400);
            $table->string('phone', 20);
            $table->string('email', 200);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_CLIENTS);
        Schema::enableForeignKeyConstraints();
    }
};
