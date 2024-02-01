<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_RESOURCE_FILES')) define('TABLE_RESOURCE_FILES', 'resource_files');

return new class extends Migration {

    public function up(): void {
        Schema::create(TABLE_RESOURCE_FILES, function (Blueprint $table) {
            $table->id();
            $table->string('entity', 100)->nullable();
            $table->bigInteger('entity_id')->nullable();
            $table->enum('type', ['image', 'video', 'pdf', 'file']);
            $table->string('path', 1000);
            $table->json('metadata')->nullable();
            $table->smallInteger('order')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_RESOURCE_FILES);
        Schema::enableForeignKeyConstraints();
    }
};
