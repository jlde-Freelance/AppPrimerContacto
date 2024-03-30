<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_REAL_ESTATE_REQUEST')) define('TABLE_REAL_ESTATE_REQUEST', 'real_estates_requests');

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create(TABLE_REAL_ESTATE_REQUEST, function (Blueprint $table) {

            $table->id();
            $table->foreignId('client_id')->references('id')->on(TABLE_CLIENTS);
            $table->json('type_ids')->nullable();
            $table->foreignId('action_id')->nullable()->references('id')->on(TABLE_MASTER_OPTIONS);
            $table->json('unit_ids')->nullable();
            $table->json('location_ids')->nullable();
            $table->decimal('rental_value', 12)->nullable();
            $table->decimal('sale_value', 12)->nullable();
            $table->tinyInteger('status')->default(1);

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
            $table->decimal('administration', 12)->comment('Administración')->nullable();

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
        Schema::dropIfExists(TABLE_REAL_ESTATE_REQUEST);
        Schema::enableForeignKeyConstraints();
    }
};
