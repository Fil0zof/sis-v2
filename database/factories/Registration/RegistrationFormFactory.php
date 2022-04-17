<?php

namespace Database\Factories\Registration;

use App\Models\General\Member;
use App\Models\OrganizationUnit\Group;
use App\Models\OrganizationUnit\Troop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegistrationFormFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'info' => $this->faker->randomHtml,
            'has_donation' => $this->faker->boolean,
            'coordinator_member_id' => Member::factory()->create()->id,
            'group_id' => Group::factory()->create()->id,
            'troop_id' => Troop::factory()->create()->id,
        ];
    }
}
