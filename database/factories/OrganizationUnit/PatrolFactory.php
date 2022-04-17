<?php

namespace Database\Factories\OrganizationUnit;

use App\Models\General\Member;
use App\Models\OrganizationUnit\Troop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PatrolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'leader_id' => Member::factory()->create()->id,
            'troop_id' => Troop::factory()->create()->id,
        ];
    }
}
