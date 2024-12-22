<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\User;
use App\Models\ArchiveBarangay;
use App\Models\IncidentType;
use App\Models\ArchiveIncident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangayAndIncident extends Controller
{
    public function incident()
    {
        $types = User::all();

        $agencies = User::select('agency', 'contact', 'email')
            ->where('role', 1)
            ->distinct()
            ->get();

        return view('admin.add.add-incident', compact('agencies', 'types'));
    }


    public function add_incident(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:7',
            'agency' => 'nullable|string|max:100',
            'contact' => 'nullable|string|max:15',
            'email' => 'nullable|email|max:255',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        IncidentType::create([
            'name' => $request->name,
            'image' => $imageName,
            'color' => $request->color,
            'agency' => $request->agency,
            'contact' => $request->contact,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.incident')->with('success', 'Incident added successfully!');
    }

    public function barangay()
    {
        return view('admin.add.add-barangay');
    }

    public function add_barangay(Request $request)
    {
        $request->validate([
            'barangay' => 'required|string|max:255',
        ]);

        Barangay::create([
            'barangay' => $request->barangay,
        ]);

        return redirect()->route('admin.barangay')->with('success', 'Barangay added successfully');
    }

    public function bar()
    {
        $bar = Barangay::all();
        $arcbar = ArchiveBarangay::all();

        return view('admin.del.barangay', compact('bar', 'arcbar'));
    }

    public function archive_bar($id)
    {
        $barangay = Barangay::findOrFail($id);

        $archiveData = $barangay->toArray();
        $archiveData['created_at'] = $barangay->created_at->format('Y-m-d H:i:s');
        $archiveData['updated_at'] = $barangay->updated_at->format('Y-m-d H:i:s');

        DB::table('archive_barangays')->insert($archiveData);

        $barangay->delete();

        return redirect()->route('admin.bar')->with('success', 'Barangay archived successfully');
    }

    public function unarchive_bar($id)
    {
        $barangayarc = ArchiveBarangay::findOrFail($id);

        $archiveData = $barangayarc->toArray();
        $archiveData['created_at'] = $barangayarc->created_at->format('Y-m-d H:i:s');
        $archiveData['updated_at'] = $barangayarc->updated_at->format('Y-m-d H:i:s');

        DB::table('barangays')->insert($archiveData);

        $barangayarc->delete();

        return redirect()->route('admin.bar')->with('success', 'Barangay unarchived successfully');
    }


    public function inc()
    {
        $inc = IncidentType::all();
        $arcinc = ArchiveIncident::all();

        return view('admin.del.incident', compact('inc', 'arcinc'));
    }

    public function archive_inc($id)
    {
        $incident = IncidentType::findOrFail($id);

        $archiveData = $incident->toArray();
        $archiveData['created_at'] = $incident->created_at->format('Y-m-d H:i:s');
        $archiveData['updated_at'] = $incident->updated_at->format('Y-m-d H:i:s');

        DB::table('archive_incidents')->insert($archiveData);

        $incident->delete();

        return redirect()->route('admin.inc')->with('success', 'Incident archived successfully');
    }

    public function unarchive_inc($id)
    {
        $incident = ArchiveIncident::findOrFail($id);


        $archiveData = $incident->toArray();
        $archiveData['created_at'] = $incident->created_at->format('Y-m-d H:i:s');
        $archiveData['updated_at'] = $incident->updated_at->format('Y-m-d H:i:s');

        DB::table('incident_types')->insert($archiveData);

        $incident->delete();

        return redirect()->route('admin.inc')->with('success', 'Incident unarchived successfully.');
    }
}
