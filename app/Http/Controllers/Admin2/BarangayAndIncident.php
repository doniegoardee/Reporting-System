<?php

namespace App\Http\Controllers\Admin2;

use App\Http\Controllers\Controller;
use App\Models\Barangay;
use App\Models\IncidentType;
use Illuminate\Http\Request;

class BarangayAndIncident extends Controller
{

    public function incident()
    {
        return view('admin-2.add.add-incident');
    }




    public function add_incident(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'color' => 'nullable|string|max:7',
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
        ]);


        return redirect()->route('admin-2.incident')->with('success', 'Incident added successfully!');
    }




    public function barangay()
    {
        return view('admin-2.add.add-barangay');
    }





    public function add_barangay(Request $request)
    {

        $request->validate([
            'barangay' => 'required|string|max:255',
        ]);

        Barangay::create([
            'barangay' => $request->barangay,
        ]);

        return redirect()->route('admin-2.barangay')->with('success', '');
    }




    public function bar()
    {
        $bar = Barangay::all();

        return view('admin-2.del.barangay', compact('bar'));
    }



    public function del_bar($id)
    {

        $barangay = Barangay::findOrFail($id);
        $barangay->delete();

        return redirect()->route('admin-2.bar')->with('success', 'Barangay deleted successfully');
    }




    public function inc()
    {

        $inc = IncidentType::all();

        return view('admin-2.del.incident', compact('inc'));
    }




    public function del_inc($id)
    {

        $incident = IncidentType::findOrFail($id);
        $incident->delete();

        return redirect()->route('admin-2.inc')->with('success', 'Incident deleted successfully');
    }
}
