<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_administrator_can_view_account_settings(): void
    {
        $administrator = User::factory()->create(['username' => 'admin']);

        $this->actingAs($administrator)
            ->get(route('admin.account.edit'))
            ->assertOk()
            ->assertSeeText('Dados de acesso')
            ->assertSee('value="admin"', false);
    }

    public function test_administrator_can_change_login_and_password(): void
    {
        $administrator = User::factory()->create([
            'username' => 'admin',
            'password' => 'senha-atual',
        ]);
        $this->actingAs($administrator);

        $this->put(route('admin.account.update'), [
            'username' => 'novo-admin',
            'current_password' => 'senha-atual',
            'new_password' => 'nova-senha-segura',
            'new_password_confirmation' => 'nova-senha-segura',
        ])->assertRedirect(route('admin.account.edit'));

        $this->assertDatabaseHas('users', [
            'id' => $administrator->id,
            'username' => 'novo-admin',
        ]);
        $this->assertTrue(Hash::check('nova-senha-segura', $administrator->refresh()->password));

        $this->post(route('admin.logout'));
        $this->post(route('admin.login.store'), [
            'username' => 'novo-admin',
            'password' => 'nova-senha-segura',
        ])->assertRedirect(route('admin.found-items.index'));
    }

    public function test_current_password_is_required_to_change_account_credentials(): void
    {
        $administrator = User::factory()->create([
            'username' => 'admin',
            'password' => 'senha-atual',
        ]);

        $this->actingAs($administrator)
            ->put(route('admin.account.update'), [
                'username' => 'novo-admin',
                'current_password' => 'senha-incorreta',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors('current_password');

        $this->assertDatabaseHas('users', [
            'id' => $administrator->id,
            'username' => 'admin',
        ]);
        $this->assertTrue(Hash::check('senha-atual', $administrator->refresh()->password));
    }

    public function test_login_must_be_unique_when_changing_account_credentials(): void
    {
        User::factory()->create(['username' => 'outro-admin']);
        $administrator = User::factory()->create([
            'username' => 'admin',
            'password' => 'senha-atual',
        ]);

        $this->actingAs($administrator)
            ->put(route('admin.account.update'), [
                'username' => 'outro-admin',
                'current_password' => 'senha-atual',
            ])
            ->assertRedirect()
            ->assertSessionHasErrors('username');
    }
}
