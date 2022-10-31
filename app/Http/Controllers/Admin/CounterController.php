<?php

namespace App\Http\Controllers\Admin;

use App\Counter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CounterController extends Controller
{
    /**
     * Display a list of Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::getList();

        return view('admin.counters.index', compact('counters'));
    }

    /**
     * Show the form for creating a new Counter
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.counters.add');
    }

    /**
     * Save new Counter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Counter::validationRules());
        $counter = Counter::create($validatedData);
        return redirect()->route('admin.counters.index')->with([
                'type' => 'success',
                'message' => 'Counter added'
            ]);

    }

    /**
     * Show the form for editing the specified Counter
     *
     * @param \App\Counter $counter
     * @return \Illuminate\Http\Response
     */
    public function edit(Counter $counter)
    {
        return view('admin.counters.edit', compact('counter'));
    }

    /**
     * Update the Counter
     *
     * @param \App\Counter $counter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Counter $counter)
    {
        $validatedData = request()->validate(
            Counter::validationRules($counter->id)
        );

        $counter->update($validatedData);

        return redirect()->route('admin.counters.index')->with([
            'type' => 'success',
            'message' => 'Counter Updated'
        ]);
    }

    /**
     * Delete the Counter
     *
     * @param \App\Counter $counter
     * @return void
     */
    public function destroy(Counter $counter)
    {
        $counter->delete();
        return redirect()->route('admin.counters.index')->with([
            'type' => 'success',
            'message' => 'Counter deleted successfully'
        ]);
    }
}
