<?php

namespace Database\Factories;

use App\Models\RealEstate;
use App\Models\ResourceFile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ResourceFile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $realEstateIds = RealEstate::pluck('id')->toArray();

        return [
            'entity' => RealEstate::class,
            'entity_id' => $this->faker->randomElement($realEstateIds),
            'type' => 'image',
            'path' => '',
            'metadata' => json_encode(['description' => $this->faker->sentence()]),
            'status' => $this->faker->boolean(90),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
