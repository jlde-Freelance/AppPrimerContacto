<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\RealEstate;
use App\Models\MasterOptions;
use App\Types\MasterOptionsType;
use Illuminate\Database\Eloquent\Factories\Factory;

class RealEstateFactory extends Factory
{

    /**
     * @var string
     */
    protected $model = RealEstate::class;

    /**
     * @return array|mixed[]
     */
    public function definition()
    {
        $type = MasterOptions::where('type', MasterOptionsType::TYPE_REAL_ESTATE)->inRandomOrder()->first();
        $action = MasterOptions::where('type', MasterOptionsType::TYPE_REAL_ESTATE_ACTION)->inRandomOrder()->first();
        $location = Location::inRandomOrder()->first();

        return [
            'code' => $this->faker->unique()->regexify('[A-Za-z0-9]{10}'),
            'type_id' => $type->id,
            'action_id' => $action->id,
            'unit_id' => null,
            'location_id' => $location->id,
            'rental_value' => $this->faker->randomFloat(2, 500, 5000),
            'sale_value' => $this->faker->randomFloat(2, 100000, 1000000),
            'description' => $this->faker->sentence(),
            'status' => $this->faker->boolean(70),
            'address' => $this->faker->address(),
            'neighborhood' => $this->faker->citySuffix(),
            'latitude' => $this->faker->randomFloat(6, 6.2, 6.4),
            'longitude' => $this->faker->randomFloat(6, -75.6, -75.4),
            'house_level' => $this->faker->numberBetween(1, 3),
            'apartment_level' => $this->faker->numberBetween(1, 10),
            'bedrooms' => $this->faker->numberBetween(1, 6),
            'bathrooms' => $this->faker->numberBetween(1, 4),
            'parking' => $this->faker->numberBetween(0, 3),
            'total_area' => $this->faker->numberBetween(100, 500) . ' m²',
            'built_area' => $this->faker->numberBetween(80, 400) . ' m²',
            'apartment_area' => $this->faker->numberBetween(50, 200) . ' m²',
            'year_of_remodeling' => $this->faker->year(),
            'administration' => $this->faker->randomFloat(2, 50, 500),
            'created_by' => 1, // Admin
            'updated_by' => 1, // Admin
            'specifications' => json_encode(['spec1' => $this->faker->word, 'spec2' => $this->faker->word]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
