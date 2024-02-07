<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_REAL_ESTATE')) define('TABLE_REAL_ESTATE', 'real_estates');

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create(TABLE_REAL_ESTATE, function (Blueprint $table) {

            $table->id();
            $table->uuid();
            $table->string('code', 10);
            $table->foreignId('type_id')->references('id')->on(TABLE_MASTER_OPTIONS);
            $table->foreignId('action_id')->references('id')->on(TABLE_MASTER_OPTIONS);
            $table->foreignId('unit_id')->nullable()->references('id')->on(TABLE_RESIDENTIAL_UNITS);
            $table->foreignId('location_id')->nullable()->references('id')->on(TABLE_LOCATIONS);
            $table->decimal('rental_value', 12)->nullable();
            $table->decimal('sale_value', 12)->nullable();
            $table->string('image_primary', 100)->nullable();
            $table->string('description', 2000)->nullable();
            $table->tinyInteger('status')->default(0);

            $table->string('address', 200)->comment('Dirección')->nullable();
            $table->string('neighborhood', 50)->comment('Barrio')->nullable();
            $table->string('latitude', 30)->comment('Latitud')->nullable();
            $table->string('longitude', 30)->comment('Longitud')->nullable();
            $table->string('house_level', 30)->comment('Cuantos Pisos')->nullable();
            $table->string('apartment_level', 30)->comment('Piso')->nullable();
            $table->string('bedrooms', 30)->comment('Habitaciones')->nullable();
            $table->string('bathrooms', 30)->comment('Baños')->nullable();
            $table->string('parking', 30)->comment('Parqueadero')->nullable();
            $table->string('total_area', 30)->comment('Área total')->nullable();
            $table->string('built_area', 30)->comment('Área construida')->nullable();
            $table->string('apartment_area', 30)->comment('Área apartamento')->nullable();
            $table->string('year_of_remodeling', 30)->comment('Año de remodelado')->nullable();
            $table->string('administration', 30)->comment('Administración')->nullable();

            $table->foreignId('created_by')->nullable()->references('id')->on(TABLE_USER);
            $table->foreignId('updated_by')->nullable()->references('id')->on(TABLE_USER);

            $table->json('specifications')->nullable();

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_REAL_ESTATE);
        Schema::enableForeignKeyConstraints();
    }
};
