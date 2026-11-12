<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_separate_from_the_public_board(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSeeText('Painel administrativo')
            ->assertSeeText('Acessar o mural público');
    }

    public function test_seeded_administrator_can_log_in_with_the_default_credentials(): void
    {
        $this->seed();

        $response = $this->post(route('admin.login.store'), [
            'username' => 'admin',
            'password' => 'admin',
        ]);

        $response->assertRedirect(route('admin.found-items.index'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'admin@achados.local',
            'username' => 'admin',
        ]);
        $this->assertTrue(Hash::check('admin', User::query()->where('username', 'admin')->value('password')));
    }

    public function test_invalid_credentials_do_not_authenticate_the_visitor(): void
    {
        $this->post(route('admin.login.store'), [
            'username' => 'admin',
            'password' => 'incorreta',
        ])
            ->assertRedirect()
            ->assertSessionHasErrors('username');

        $this->assertGuest();
    }

    public function test_guest_is_redirected_to_the_login_page_from_administration(): void
    {
        $this->get(route('admin.found-items.index'))
            ->assertRedirect(route('login'));
    }

    public function test_administrator_can_log_out_to_the_public_board(): void
    {
        $this->actingAs(User::factory()->create(['username' => 'admin']))
            ->post(route('admin.logout'))
            ->assertRedirect(route('found-items.index'));

        $this->assertGuest();
    }
}
