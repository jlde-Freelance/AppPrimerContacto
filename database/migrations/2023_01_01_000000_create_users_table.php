<?php

use App\Types\UserProfile;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

if (!defined('TABLE_USER')) define('TABLE_USER', 'users');

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        $enumProfile = [array_map(fn($status) => $status->value, UserProfile::cases())];
        Schema::create(TABLE_USER, function (Blueprint $table) use ($enumProfile) {
            $table->id();
            $table->uuid()->default(DB::raw('(UUID())'));
            $table->string('name', 200);
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->enum('profile', $enumProfile)->default(UserProfile::VIGILANT);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists(TABLE_USER);
        Schema::enableForeignKeyConstraints();
    }
};
