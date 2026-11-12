<?php

namespace Tests\Feature;

use App\Models\FoundItem;
use App\Models\ItemRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FoundItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_admin_can_create_a_found_item_with_a_photo(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());

        $response = $this->post(route('admin.found-items.store'), [
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca, ao lado da entrada.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'photo' => UploadedFile::fake()->create('chaveiro.jpg', 10, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('admin.found-items.index'));
        $this->assertDatabaseHas('found_items', [
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca, ao lado da entrada.',
            'location' => 'Biblioteca',
        ]);

        $item = FoundItem::query()->firstOrFail();
        Storage::disk('public')->assertExists($item->image_path);
    }

    public function test_an_admin_can_edit_a_found_item_without_replacing_its_photo(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $imagePath = 'found-items/chaveiro.jpg';
        Storage::disk('public')->put($imagePath, 'fake image');
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => $imagePath,
        ]);

        $this->get(route('admin.found-items.edit', $item))
            ->assertOk()
            ->assertSeeText('Editar item');

        $response = $this->put(route('admin.found-items.update', $item), [
            'name' => 'Chaveiro azul atualizado',
            'description' => 'Encontrado perto da biblioteca, na entrada.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
        ]);

        $response->assertRedirect(route('admin.found-items.index'));
        $this->assertDatabaseHas('found_items', [
            'id' => $item->id,
            'name' => 'Chaveiro azul atualizado',
            'image_path' => $imagePath,
        ]);
        Storage::disk('public')->assertExists($imagePath);
    }

    public function test_a_student_can_request_a_found_item(): void
    {
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => 'found-items/chaveiro.jpg',
        ]);

        $this->get(route('found-items.index'))
            ->assertOk()
            ->assertSeeText('Itens encontrados')
            ->assertSeeText('Número de contato')
            ->assertDontSeeText('Excluir item');

        $response = $this->post(route('item-requests.store', $item), [
            'student_name' => 'Ana Souza',
            'email' => 'ana@example.com',
            'contact_number' => '+55 (11) 99999-1234',
            'message' => 'O chaveiro tem uma fita vermelha que reconheço.',
        ]);

        $response->assertRedirect(route('found-items.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('item_requests', [
            'found_item_id' => $item->id,
            'student_name' => 'Ana Souza',
            'email' => 'ana@example.com',
            'contact_number' => '+55 (11) 99999-1234',
            'status' => 'pending',
        ]);
        $this->assertDatabaseHas('item_requests', [
            'found_item_id' => $item->id,
            'contact_number' => '+55 (11) 99999-1234',
        ]);
    }

    public function test_a_request_requires_a_valid_email(): void
    {
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => 'found-items/chaveiro.jpg',
        ]);

        $this->from(route('found-items.index'))
            ->post(route('item-requests.store', $item), [
                'student_name' => 'Ana Souza',
                'email' => 'email-invalido',
                'contact_number' => '+55 (11) 99999-1234',
                'message' => 'Acredito que este objeto seja meu.',
            ])
            ->assertRedirect(route('found-items.index'))
            ->assertSessionHasErrors('email');

        $this->assertDatabaseCount('item_requests', 0);
    }

    public function test_a_request_requires_a_contact_number(): void
    {
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => 'found-items/chaveiro.jpg',
        ]);

        $this->from(route('found-items.index'))
            ->post(route('item-requests.store', $item), [
                'student_name' => 'Ana Souza',
                'email' => 'ana@example.com',
                'message' => 'Acredito que este objeto seja meu.',
            ])
            ->assertRedirect(route('found-items.index'))
            ->assertSessionHasErrors('contact_number');

        $this->assertDatabaseCount('item_requests', 0);
    }

    public function test_an_admin_can_delete_a_found_item_and_its_photo(): void
    {
        Storage::fake('public');
        $this->actingAs(User::factory()->create());
        $imagePath = 'found-items/chaveiro.jpg';
        Storage::disk('public')->put($imagePath, 'fake image');
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => $imagePath,
        ]);
        ItemRequest::create([
            'found_item_id' => $item->id,
            'student_name' => 'Ana Souza',
            'email' => 'ana@example.com',
            'contact_number' => '+55 (11) 99999-1234',
            'message' => 'Acredito que este objeto seja meu.',
        ]);

        $this->get(route('admin.found-items.index'))
            ->assertOk()
            ->assertSeeText('Ana Souza')
            ->assertSeeText('+55 (11) 99999-1234');

        $response = $this->delete(route('admin.found-items.destroy', $item));

        $response->assertRedirect(route('admin.found-items.index'));
        $this->assertDatabaseMissing('found_items', ['id' => $item->id]);
        $this->assertDatabaseMissing('item_requests', ['found_item_id' => $item->id]);
        Storage::disk('public')->assertMissing($imagePath);
    }
}
