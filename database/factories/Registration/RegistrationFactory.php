<?php

namespace Database\Factories\Registration;

use App\Models\General\LegalRepresentative;
use App\Models\General\Member;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RegistrationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'year' => $this->faker->year,
            'fee' => $this->faker->randomFloat(2, 1, 100),
            'donate' => $this->faker->randomFloat(2, 1, 100),
            'payed' => $this->faker->randomFloat(2, 1, 100),
            'note' => $this->faker->text,
            'legal_representative_id' => LegalRepresentative::factory()->create()->id,
            'legal_member_id' => Member::factory()->create()->id,
        ];
    }

}
