<?php

namespace Database\Factories\General;

use App\Models\General\Address;
use App\Models\General\LegalRepresentative;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\General\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->unique()->phoneNumber(),
            'health_problems' => $this->faker->text(),
            'dietary_restrictions' => $this->faker->text(),
            'is_disadvantaged' => $this->faker->boolean(),
            'has_card' => $this->faker->boolean(),
            'form_received' => $this->faker->boolean(),
            'is_legal_representative' => $this->faker->boolean(),
            'address_id' => Address::factory()->create()->id,
            'legal_representative_id' => LegalRepresentative::factory()->create()->id,
        ];
    }

}
