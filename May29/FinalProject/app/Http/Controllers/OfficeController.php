<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    // Show list of offices
    public function index()
    {
        $offices = Office::orderBy('office_name')->get();
        return view('offices.index', compact('offices'));
    }

    // Show form to create new office
    public function create()
    {
        return view('offices.create');
    }

    // Store new office
    public function store(Request $request)
    {
        $request->validate([
            'office_name' => 'required|string|max:255|unique:offices,office_name',
        ]);

        Office::create(['office_name' => $request->office_name]);

        return redirect()->route('offices.index')->with('success', 'Office added successfully.');
    }

    // Show form to edit an office
    public function edit(Office $office)
    {
        return view('offices.edit', compact('office'));
    }

    // Update office name
    public function update(Request $request, Office $office)
    {
        $request->validate([
            'office_name' => 'required|string|max:255|unique:offices,office_name,' . $office->id,
        ]);

        $office->update(['office_name' => $request->office_name]);

        return redirect()->route('offices.index')->with('success', 'Office updated successfully.');
    }

    // Delete an office
    public function destroy(Office $office)
    {
        $office->delete();

        return redirect()->route('offices.index')->with('success', 'Office deleted successfully.');
    }
}
