<?php

namespace Database\Seeders\Helpers;

use App\Models\Character\Item;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

final class StartingOutfit extends BaseHelper
{


    public function withItem(string $key, int $quantity = 1): self
    {
        $this->validate($key);

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'item',
            'item_key' => $key,
            'quantity' => $quantity,
        ];

        return $clone;
    }


    public function withDaisho(): self
    {
        $clone = clone $this;

        $clone->data[] = [
            'type' => 'daisho',
        ];
        return $clone;
    }


    public function withTravelingPack(): self
    {
        $clone = clone $this;

        $clone->data[] = [
            'type' => 'traveling_pack',
        ];

        return $clone;
    }


    public function withChoice(array $keys, int $choices = 1): self
    {
        foreach ($keys as $key) {
            $this->validate($key);
        }

        $clone = clone $this;
        $clone->data[] = [
            'type' => 'choice',
            'item_keys' => $keys,
            'choices' => $choices,
        ];

        return $clone;
    }


    private function validate(string $key): void
    {
        try {
            Item::query()->where('key', $key)->firstOrFail(['id']);
        } catch (ModelNotFoundException $e) {
            throw new Exception('Item with key "' . $key . "' not found.");
        }
    }
}
