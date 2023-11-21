<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('master_options', function (Blueprint $table) {
            $table->id();
            $table->string('type', 200);
            $table->string('key', 100)->unique();
            $table->string('value', 5000);
            $table->smallInteger('order');
            $table->foreignId('parent_id')->nullable()->references('id')->on('master_options');
            $table->boolean('children')->default(false);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('master_options');
    }
};
