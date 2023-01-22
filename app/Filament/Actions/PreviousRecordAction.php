<?php

namespace App\Filament\Actions;

use Filament\Pages\Actions\Action;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;

final class PreviousRecordAction extends Action
{
    use CanCustomizeProcess;

    private static string $resource = '';


    public static function getDefaultName(): ?string
    {
        return 'previous-record';
    }


    public static function create(string $resource, Model $record): static
    {
        static::$resource = $resource;

        return static::make()->record($record)->keyBindings('ctrl+space');
    }


    protected function setUp(): void
    {
        parent::setUp();

        $this->label('Previous Record');

        $this->hidden(static function (Model $record): bool {
            $next = $record->query()->where('id', '<', $record->id)->max('id');

            return $next === null;
        });

        $this->url(function (Model $record): string {
            $prev = $record->query()->where('id', '<', $record->id)->max('id');

            if (static::$resource) {
                return static::$resource::getUrl('edit', [
                    'record' => $record->query()->where('id', $prev)->first(),
                ]);
            }

            return '';
        });
    }
}
