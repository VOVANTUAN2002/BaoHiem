<?php

namespace Tests\Unit;

use App\Models\User;
use Faker\Factory as Faker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Log;

class UserTest extends TestCase
{
    // public function __construct()
    // {
    //     $this->faker = Faker::create();
    // }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_user()
    {
        // $this->faker = Faker::create();
        // $user = new User();
        // $user->name             = $this->faker->name;
        // $user->gender           = 'male';
        // $user->day_of_birth     = date('Y-m-d');
        // $user->address          = 'test';
        // $user->email            = '$this->faker->unique()->safeEmail()';
        // $user->phone            = rand(124543433, 1234567888);
        // $user->password         = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        // $user->start_day        = date('Y-m-d');
        // $user->user_group_id    = 1;
        // $user->branch_id        = 1;
        // $user->province_id      = rand(1, 2);
        // $user->district_id      = rand(1, 2);
        // $user->ward_id          = rand(1, 2);
        // $user->note             = '';
        // $user->avatar             = 'test';

        // try {
        //     $user->save();
        //     $this->assertTrue(true);
        // } catch (\Exception $e) {
        //     Log::error($e->getMessage());
        //     $this->assertTrue(false);
        // }
    }
}
