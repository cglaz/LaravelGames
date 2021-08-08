<?php

namespace Tests\Feature\Httpd;

use App\Model\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRedirectNotLoggedUserToLoginPage()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testDashboardShowing()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/');

        $response->assertStatus(200);
    }

    public function testDashboardShowingWithExtraData()
    {
        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->withCookies(['test-game' => 'Duke Nukem 3D'])
            ->withSession(['publisher' => '3D Realms'])
            ->get('/');

        $response->assertStatus(200);
    }
}
