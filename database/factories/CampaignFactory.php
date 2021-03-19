<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CampaignFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Campaign::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $title = $this->faker->sentence();
        $code = Str::upper($this->faker->word());
        $donation_target = $this->faker->numberBetween(10, 9000).'000000';
        $finished_at = Carbon::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        $finished_at->addDay($this->faker->numberBetween(30, 90));

        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'code' => $code,
            'donation_target' => $donation_target,
            'finished_at' => $finished_at,
            'published_at' => date('Y-m-d H:i:s'),
            'status' => 1,
            'short_description' => $this->faker->paragraph(),
            'description' => $this->faker->paragraph(),
            'verified_at' => date('Y-m-d H:i:s'),
            'verified_by' => $user->id,
            'user_id' => $user->id,
        ];
    }
}
