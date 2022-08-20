<?php

namespace App\Http\Requests\Api\Character;

use App\Validation\Rules;
use Illuminate\Support\Arr;

final class SaveInventoryRequest extends SaveRequest
{


    public function rules(): array
    {
        return [
            'inventory' => (new Rules())
                ->array()
                ->required(),
            'inventory.containers' => (new Rules())
                ->array()
                ->required(),
            'inventory.containers.*.id' => (new Rules())
                ->uuid()
                ->required(),
            'inventory.containers.*.name' => (new Rules())
                ->string()
                ->required(),
        ];
    }


    public function containers(): array
    {
        $current = Arr::get($this->all(), 'inventory.containers');
        assert(is_array($current));

        $containers = [];

        foreach ($current as $container) {
            $proxyContainer = [
                'id' => $container['id'],
                'name' => $container['name'],
                'items' => [],
            ];

            foreach ($container['items'] as $item) {
                if (array_key_exists('shouldRemove', $item) && $item['shouldRemove']) {
                    continue;
                }

                $proxyItem = [
                    'item_key' => $item['item_key'],
                    'quantity' => $item['quantity'],
                ];

                if (array_key_exists('custom_name', $item)) {
                    $proxyItem['custom_name'] = $item['custom_name'];
                }

                $proxyContainer['items'][] = $proxyItem;
            }

            $containers[]  = $proxyContainer;
        }

        return $containers;
    }
}
