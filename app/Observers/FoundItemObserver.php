<?php

namespace App\Observers;

use App\Models\FoundItem;
use App\Models\FoundItemActivity;
use Illuminate\Support\Facades\Auth;

class FoundItemObserver
{
    private const TRACKED_FIELDS = ['name', 'description', 'found_at', 'location', 'image_path'];

    public function created(FoundItem $item): void
    {
        $this->record($item, 'created', $this->snapshot($item));
    }

    public function updated(FoundItem $item): void
    {
        $changedValues = $item->getChanges();
        $previousValues = $item->getPrevious();
        $changes = [];

        foreach (self::TRACKED_FIELDS as $field) {
            if (array_key_exists($field, $changedValues)) {
                $changes[$field] = [
                    'old' => $previousValues[$field] ?? null,
                    'new' => $changedValues[$field],
                ];
            }
        }

        if ($changes !== []) {
            $this->record($item, 'updated', $this->snapshot($item), $changes);
        }
    }

    public function deleted(FoundItem $item): void
    {
        $this->record($item, 'deleted', $this->snapshot($item));
    }

    private function record(FoundItem $item, string $action, array $snapshot, ?array $changes = null): void
    {
        $user = Auth::user();

        FoundItemActivity::create([
            'found_item_id' => $item->getKey(),
            'user_id' => $user?->getAuthIdentifier(),
            'actor' => $user?->username,
            'action' => $action,
            'item_name' => $item->name,
            'snapshot' => $snapshot,
            'changes' => $changes,
        ]);
    }

    private function snapshot(FoundItem $item): array
    {
        return array_intersect_key($item->getAttributes(), array_flip(self::TRACKED_FIELDS));
    }
}
