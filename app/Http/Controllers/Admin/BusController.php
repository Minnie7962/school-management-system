<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('admin.buses.index', compact('buses'));
    }

    public function create()
    {
        return view('admin.buses.create');
    }

    public function store(Request $request)
    {
        $bus = new Bus();
        // Populate the bus model with form data
        $bus->save();
        return redirect()->route('admin.buses.index');
    }

    // Add other CRUD methods (show, edit, update, destroy) as needed
}
