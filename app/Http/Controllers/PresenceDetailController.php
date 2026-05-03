<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PresenceDetail;

class PresenceDetailController extends Controller
{
    public function destroy($id)
    {
        $presenceDetail = PresenceDetail::findOrFail($id);

        if ($presenceDetail->tanda_tangan) {
            Storage::disk('public_uploads')->delete($presenceDetail->tanda_tangan);
        }

        $presenceDetail->delete();

        return redirect()->back();
    }
}
