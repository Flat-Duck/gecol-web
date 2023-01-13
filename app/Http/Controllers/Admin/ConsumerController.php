<?php

namespace App\Http\Controllers\Admin;

use App\Consumer;
use App\Http\Controllers\Controller;
use App\Office;
use App\User;

class ConsumerController extends Controller
{
    /**
     * Display a list of Consumers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = Consumer::getList(request()->search);
        return view('admin.consumers.index', compact('consumers'));
    }

    /**
     * Show the form for creating a new Consumer
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $offices = Office::all();

        return view('admin.consumers.add', compact('offices'));
    }

    /**
     * Save new Consumer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $validatedData = request()->validate(Consumer::validationRules());
        $consumer = Consumer::create($validatedData);
        $user = User::firstOrCreate(
            ['name'=> request()->name,
            'email'=> request()->name. '@gecol.test',
            'n_id'=> request()->n_id,
            'password'=> bcrypt(request()->phone)]
        );
        return redirect()->route('admin.consumers.index')->with([
            'type' => 'success',
            'message' => 'Consumer added'
        ]);
    }

    /**
     * Show the form for editing the specified Consumer
     *
     * @param \App\Consumer $consumer
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumer $consumer)
    {
       $offices = Office::all();
        return view('admin.consumers.edit', compact('consumer','offices'));
    }

    /**
     * Update the Consumer
     *
     * @param \App\Consumer $consumer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Consumer $consumer)
    {

        $validatedData = request()->validate(
            Consumer::validationRules($consumer->id)
        );
         $consumer->update($validatedData);
        return redirect()->route('admin.consumers.index')->with([
            'type' => 'success',
            'message' => 'Consumer Updated'
        ]);
    }

    /**
     * Delete the Consumer
     *
     * @param \App\Consumer $consumer
     * @return void
     */
    public function destroy(Consumer $consumer)
    {
        $consumer->toggleActivation();

        return redirect()->route('admin.consumers.index')->with([
            'type' => 'success',
            'message' => 'تم تغيير الحالة بنجاح'
        ]);
    }
}