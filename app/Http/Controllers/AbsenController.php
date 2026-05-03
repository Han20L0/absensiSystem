<?php

namespace App\Http\Controllers;

use App\Models\Presence;
use App\Models\PresenceDetail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use View;

class AbsenController extends Controller
{
    public function index($slug)
    {
        $presence = Presence::where("slug", $slug)->first();
        $presenceDetails = PresenceDetail::where("presence_id", $presence->id)->get();
        return view('pages.absen.index', compact('presence','presenceDetails'));
    }

    public function save(Request $request, string $id)
    {
        $presence = Presence::findOrFail($id);

        $request->validate([
            'nama'          => 'required|string|max:255',
            'nip'           => 'required|string|max:20|',
            'no_hp'         => 'required|string|max:15',
            'asal_instansi' => 'required|string|max:255',
            'jabatan'       => 'required|string|max:255',
            'email'         => 'required|email|max:255|unique:users,email',
            'signature'   => 'required',
        ]);

        $presenceDetail = new PresenceDetail();
        $presenceDetail->presence_id = $presence->id;
        $presenceDetail->nama = $request->nama;
        $presenceDetail->nip = $request->nip;
        $presenceDetail->no_hp = $request->no_hp;
        $presenceDetail->asal_instansi = $request->asal_instansi;
        $presenceDetail->jabatan = $request->jabatan;
        $presenceDetail->email = $request->email;

        //Decode signature
        $base64_image = $request->signature;
        @list($type, $file_data) = explode(';', $base64_image);
        @list(, $file_data) = explode(',', $file_data);

        //generate file name
        $uniqChar =  date('YmdHis') . uniqid();
        $signatureFileName = "tanda-tangan/{$uniqChar}.png";

        //save signature to storage
        Storage::disk('public_uploads')->put($signatureFileName, base64_decode($file_data));

        $presenceDetail->tanda_tangan = $signatureFileName;
        $presenceDetail->save();

        return redirect()->back();



    }
}
