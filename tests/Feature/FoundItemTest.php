<?php

namespace Tests\Feature;

use App\Models\FoundItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FoundItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_found_item_can_be_created_with_a_photo(): void
    {
        Storage::fake('public');

        $response = $this->post(route('found-items.store'), [
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca, ao lado da entrada.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'photo' => UploadedFile::fake()->create('chaveiro.jpg', 10, 'image/jpeg'),
        ]);

        $response->assertRedirect(route('found-items.index'));
        $this->assertDatabaseHas('found_items', [
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca, ao lado da entrada.',
            'location' => 'Biblioteca',
        ]);

        $item = FoundItem::query()->firstOrFail();
        Storage::disk('public')->assertExists($item->image_path);
    }

    public function test_a_found_item_can_be_deleted_with_its_photo(): void
    {
        Storage::fake('public');
        $imagePath = 'found-items/chaveiro.jpg';
        Storage::disk('public')->put($imagePath, 'fake image');
        $item = FoundItem::create([
            'name' => 'Chaveiro azul',
            'description' => 'Encontrado perto da biblioteca.',
            'found_at' => now()->toDateString(),
            'location' => 'Biblioteca',
            'image_path' => $imagePath,
        ]);

        $this->get(route('found-items.index'))
            ->assertOk()
            ->assertSeeText('Excluir item');

        $response = $this->delete(route('found-items.destroy', $item));

        $response->assertRedirect(route('found-items.index'));
        $this->assertDatabaseMissing('found_items', ['id' => $item->id]);
        Storage::disk('public')->assertMissing($imagePath);
    }
}
