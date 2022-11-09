<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_bisa_login()
    {

        $user = User::factory()->create([
            'email' => 'id.abdasis@gmail.com',
        ]);

        $this->browse(function (Browser $browser) use($user) {

            $browser->visit('/login')
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('LOG IN')
                ->assertPathIs('/dashboard');
        });

    }
}
