<?php

namespace Database\Factories\OrganizationUnit;

use App\Models\General\Member;
use App\Models\OrganizationUnit\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TroopFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1, 10),
            'name' => $this->faker->name(),
            'leader_id' => Member::factory()->create()->id,
            'group_id' => Group::factory()->create()->id,
        ];
    }
}
