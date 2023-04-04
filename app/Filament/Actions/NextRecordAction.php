<?php

namespace App\Filament\Actions;

use Filament\Pages\Actions\Action;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;

final class NextRecordAction extends Action
{
    use CanCustomizeProcess;

    private static string $resource = '';


    public static function getDefaultName(): ?string
    {
        return 'next-record';
    }


    public static function create(string $resource, Model $record): static
    {
        static::$resource = $resource;

        return static::make()->record($record)->keyBindings('ctrl+n');
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Next Record');

        $this->hidden(static function (Model $record): bool {
            assert(property_exists($record, 'id'));
            $next = $record->query()->where('id', '>', $record->id)->min('id');

            return $next === null;
        });

        $this->url(function (Model $record): string {
            assert(property_exists($record, 'id'));
            $next = $record->query()->where('id', '>', $record->id)->min('id');

            if (static::$resource) {
                return static::$resource::getUrl('edit', [
                    'record' => $record->query()->where('id', $next)->first(),
                ]);
            }

            return '';
        });
    }
}
