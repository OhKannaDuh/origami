<?php

namespace App\Actions\Character\Character;

use App\Http\Requests\Character\UpdateRequest;
use App\Models\Character\Character;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

final class Update implements UpdateInterface
{


    public function execute(array $context = []): Character
    {
        $request = $context['request'] ?? null;
        assert($request instanceof UpdateRequest);

        $character = $context['character'] ?? null;
        assert($character instanceof Character);

        $character->update([
            'name' => $request->name(),
            'avatar' => $this->avatar($character, $request),
        ]);

        return $character;
    }


    private function avatar(Character $character, UpdateRequest $request): string
    {
        if ($request->hasFile('avatar')) {
            $storage = Storage::disk('avatars');
            assert($storage instanceof FilesystemAdapter);

            $file = $request->file('avatar');
            assert($file instanceof UploadedFile);

            $storage->put('/', $file);

            return $storage->url($file->hashName());
        }

        return $character->avatar;
    }
}
