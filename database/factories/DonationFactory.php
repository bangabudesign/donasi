<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Donation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $campaign = Campaign::factory()->create();
        $user = User::factory()->create();
        $amount = $this->faker->numberBetween(10, 900).'000';
        $comment = $this->faker->sentence();

        return [
            'campaign_id' => $campaign->id,
            'user_id' => $user->id,
            'amount' => $amount,
            'comment' => $comment,
            'status' => 1,
            'payment_type' => 'Transfer',
            'payment_status' => 1,
        ];
    }
}
