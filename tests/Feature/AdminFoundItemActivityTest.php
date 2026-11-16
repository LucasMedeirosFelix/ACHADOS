<?php

namespace Tests\Feature;

use App\Models\FoundItem;
use App\Models\FoundItemActivity;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminFoundItemActivityTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_view_the_item_activity_history(): void
    {
        $this->get(route('admin.found-item-activities.index'))
            ->assertRedirect(route('login'));
    }

    public function test_admin_can_review_item_activity_and_manage_active_items(): void
    {
        Storage::fake('public');
        $admin = User::factory()->create(['username' => 'admin']);
        $this->actingAs($admin);

        $this->post(route('admin.found-items.store'), [
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'photo' => UploadedFile::fake()->create('chaveiro.jpg', 10, 'image/jpeg'),
        ])->assertRedirect(route('admin.found-items.index'));

        $item = FoundItem::query()->firstOrFail();

        $this->put(route('admin.found-items.update', $item), [
            'name' => 'Chaveiro azul atualizado',
            'description' => 'Encontrado na entrada da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Entrada da biblioteca',
        ])->assertRedirect(route('admin.found-items.index'));

        $createdActivity = FoundItemActivity::query()->where('action', 'created')->firstOrFail();
        $this->assertSame($admin->id, $createdActivity->user_id);
        $this->assertSame('Chaveiro azul', $createdActivity->snapshot['name']);

        $updatedActivity = FoundItemActivity::query()->where('action', 'updated')->firstOrFail();
        $this->assertSame('Chaveiro azul', $updatedActivity->changes['name']['old']);
        $this->assertSame('Chaveiro azul atualizado', $updatedActivity->changes['name']['new']);

        $this->get(route('admin.found-item-activities.index'))
            ->assertOk()
            ->assertSeeText('Histórico de itens')
            ->assertSeeText('Adicionado')
            ->assertSeeText('Modificado')
            ->assertSeeText('Editar item')
            ->assertSeeText('Excluir');

        $this->delete(route('admin.found-items.destroy', $item))
            ->assertRedirect(route('admin.found-items.index'));

        $deletedActivity = FoundItemActivity::query()->where('action', 'deleted')->firstOrFail();
        $this->assertSame($item->id, $deletedActivity->found_item_id);
        $this->assertSame('Chaveiro azul atualizado', $deletedActivity->snapshot['name']);

        $this->get(route('admin.found-item-activities.index'))
            ->assertOk()
            ->assertSeeText('Deletado');
    }
}
