<?php

namespace App\Http\Controllers\Admin;

use App\Office;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    /**
     * Display a list of Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::getList(request()->search);

        return view('admin.offices.index', compact('offices'));
    }

    /**
     * Show the form for creating a new Office
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offices.add');
    }

    /**
     * Save new Office
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Office::validationRules());
        $office = Office::create($validatedData);
        return redirect()->route('admin.offices.index')->with([
                'type' => 'success',
                'message' => 'Office added'
            ]);

    }

    /**
     * Show the form for editing the specified Office
     *
     * @param \App\Office $office
     * @return \Illuminate\Http\Response
     */
    public function edit(Office $office)
    {
        return view('admin.offices.edit', compact('office'));
    }

    /**
     * Update the Office
     *
     * @param \App\Office $office
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Office $office)
    {
        $validatedData = request()->validate(
            Office::validationRules($office->id)
        );

        $office->update($validatedData);

        return redirect()->route('admin.offices.index')->with([
            'type' => 'success',
            'message' => 'Office Updated'
        ]);
    }

    /**
     * Delete the Office
     *
     * @param \App\Office $office
     * @return void
     */
    public function destroy(Office $office)
    {
        $office->toggleActivation();
        return redirect()->route('admin.offices.index')->with([
            'type' => 'success',
            'message' => 'تم تغيير الحالة بنجاح'
        ]);
    }
}
