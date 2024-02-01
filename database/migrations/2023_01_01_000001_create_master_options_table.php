<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_MASTER_OPTIONS')) define('TABLE_MASTER_OPTIONS', 'master_options');

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create(TABLE_MASTER_OPTIONS, function (Blueprint $table) {
            $table->id();
            $table->string('type', 200);
            $table->string('key', 100)->unique();
            $table->string('value', 5000);
            $table->smallInteger('order');
            $table->foreignId('parent_id')->nullable()->references('id')->on(TABLE_MASTER_OPTIONS);
            $table->boolean('children')->default(false);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_MASTER_OPTIONS);
        Schema::enableForeignKeyConstraints();
    }
};
