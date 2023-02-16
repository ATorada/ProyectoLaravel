<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        /*
            $table->id();
            $table->string('name', 15);
            $table->text('description');
            $table->boolean('visibility')->default(0);
            $table->date('date')->nullable();
            $table->time('hour')->nullable();
            $table->text('location')->nullable();
            $table->text('tags')->nullable();
            $table->timestamps();
        */
        return [
            'name' => fake()->text(15),
            'slug' => Str::slug(fake()->text(15)),
            'description' => fake()->text(),
            'visibility' => fake()->boolean(),
            'date' => fake()->date(),
            'hour' => fake()->time(),
            'location' => fake()->address(),
            'tags' => fake()->words(5, true),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
