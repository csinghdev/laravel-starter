<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use JWTAuth;

class UsersTest extends TestCase
{
    /** @test */
    public function a_user_can_edit_his_profile() {
        $user = User::first();

        $token = JWTAuth::fromUser($user);

        $attributes = ['name' => $this->faker->name];

        $this->patchJson('api/user/profile', $attributes, ['Authorization' => "bearer $token"])
            ->assertStatus(200);

        $this->assertDatabaseHas($user->getTable(), array_merge($attributes, [
            'id' => $user->id
        ]));
    }
}
