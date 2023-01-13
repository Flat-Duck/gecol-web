<?php

namespace App\Http\Controllers\Admin;

use App\Counter;
use App\Http\Controllers\Controller;
use App\Notice;
use App\Reading;
use Carbon\Carbon;

class CounterController extends Controller
{
    /**
     * Display a list of Services.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::getList(request()->search);

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
     * Show the form for creating a new Counter
     *
     * @return \Illuminate\Http\Response
     */
    public function notice(Counter $counter)
    {
        $notice =  Notice::create([
            'counter_id'=>$counter->id,
            'date' => Carbon::now()
        ]);   
        return redirect()->route('admin.counters.index')->with([
            'type' => 'success',
            'message' => 'تم ارسال اشعار الدفع بنجاح'
        ]);   
        
        
        
    }
    /**
     * Show the form for creating a new Counter
     *
     * @return \Illuminate\Http\Response
     */
    public function add_reading(Counter $counter)
    {
        $readings = $counter->readings->sortByDesc('created_at', SORT_NATURAL);

        return view('admin.counters.add_reading',compact('counter','readings'));
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
     * Save new Counter
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store_reading()
    {
        $validatedData = request()->validate(Reading::validationRules());
        $reading = Reading::create($validatedData);
        return redirect()->route('admin.counters.index')->with([
                'type' => 'success',
                'message' => 'Reading added'
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
        $counter->toggleActivation();
        return redirect()->route('admin.counters.index')->with([
            'type' => 'success',
            'message' => 'تم تغيير الحالة بنجاح'
        ]);
    }
}
