<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


if (!defined('TABLE_LOCATIONS')) define('TABLE_LOCATIONS', 'locations');

return new class extends Migration {
    public function up(): void {
        Schema::create(TABLE_LOCATIONS, function (Blueprint $table) {
            $table->id();
            $table->string('department_dane', 6);
            $table->string('department_name', 200);
            $table->string('municipality_dane', 6);
            $table->string('municipality_name', 200);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_LOCATIONS);
        Schema::enableForeignKeyConstraints();
    }

};
