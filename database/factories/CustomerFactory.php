<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'email'             => $this->faker->unique()->safeEmail(),
            'phone'             => $this->faker->phoneNumber(),
            'password'          => 'password',
            'type'              => 'user',
            'code'              => null,
            'code_expire_at'    => null,
            'reset_token_password' => null,
            'social_type'       => null,
            'social_id'         => null,
            'is_notify'         => true,
            'image'             => null,
            'email_verified_at' => now(),
        ];
    }
}
