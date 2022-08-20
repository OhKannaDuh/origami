<?php

namespace App\Http\Controllers\Campaign;

use App\Actions\Core\Campaign\DeleteInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Campaign\OwnerRequest;
use App\Models\Core\Campaign;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

final class DeleteController extends Controller
{


    protected function delete(OwnerRequest $request, Campaign $campaign, DeleteInterface $action): RedirectResponse
    {
        $action->execute(['campaign' => $campaign]);

        return Redirect::route('campaign.index.show');
    }
}
