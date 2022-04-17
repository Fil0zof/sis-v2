<?php

namespace Database\Factories\OrganizationUnit;

use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(1, 300),
            'name' => $this->faker->name(),
            'iban' => $this->faker->iban("SK"),
            'leader_id' => Member::factory()->create()->id,
        ];
    }
}
