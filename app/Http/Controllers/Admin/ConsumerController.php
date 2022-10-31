<?php

namespace App\Http\Controllers\Admin;

use App\Consumer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsumerController extends Controller
{
    /**
     * Display a list of Consumers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumers = Consumer::getList();

        return view('admin.consumers.index', compact('consumers'));
    }

    /**
     * Show the form for creating a new Consumer
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       // $services = Service::all();

        return view('admin.consumers.add');//, compact('services'));
    }

    /**
     * Save new Consumer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {


     //   $factory = (new Factory)->withServiceAccount(__DIR__.'/broken.json');
     //   $database = $factory->createDatabase();
     //   $auth = $factory->createAuth();

     //   $newPorviderId = $database->getReference('consumers')->push([
     //       'name' => request()->name,
     //       'phone' =>  request()->phone,
     //       'email' =>  request()->email,
     //       'location' => request()->location,
     //       'user_name' => request()->user_name,
     //       'password' =>  request()->password,
     //       ])->getKey();
     //   $database->getReference('Auth/'.$newPorviderId."/isConsumer")->set(true);
            
     //   $request = CreateUser::new()->withUid($newPorviderId)
     //       ->withUnverifiedEmail(request()->email)
     //       ->withPhoneNumber(request()->phone)
     //       ->withClearTextPassword( request()->password)
     //       ->withDisplayName(request()->name)
     //       ->withPhotoUrl('http://www.example.com/12345678/photo.png');
            
     //    $createdUser = $auth->createUser($request);

        
     //   request()->merge(['fbID'=>$newPorviderId]);
        $validatedData = request()->validate(Consumer::validationRules());

     //   $validatedData['password'] = bcrypt($validatedData['password']);
     //   unset($validatedData['services']);
        $consumer = Consumer::create($validatedData);

        // foreach (request()->services as $k => $serviceID) {
        //     $service = Service::find($serviceID);
        //     $database->getReference('consumer_service/'.$newPorviderId."/".$service->fbID)->set(true);
        //     $database->getReference('service_consumer/'.$service->fbID."/" .$newPorviderId)->set(true);
        // }
        // $consumer->services()->sync(request('services'));

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
       // $services = Service::all();

       // $consumer->services = $consumer->services->pluck('id')->toArray();

        return view('admin.consumers.edit', compact('consumer'));//, 'services'));
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

        // $validatedData['password'] = bcrypt($validatedData['password']);
        // unset($validatedData['services']);
         $consumer->update($validatedData);

        // $consumer->services()->sync(request('services'));

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
        // if ($consumer->services()->count()) {
        //     return redirect()->route('admin.consumers.index')->with([
        //         'type' => 'error',
        //         'message' => 'This record cannot be deleted as there are relationship dependencies.'
        //     ]);
        // }

        
        // $factory = (new Factory)->withServiceAccount(__DIR__.'/broken.json');
        // $database = $factory->createDatabase();
        // $auth = $factory->createAuth();
        
        // $uId = $consumer->fbId;
        // $database->getReference('consumers/'.$uId)->remove();

        // $auth->deleteUser($uId);
         $consumer->delete();

        return redirect()->route('admin.consumers.index')->with([
            'type' => 'success',
            'message' => 'Consumer deleted successfully'
        ]);
    }
}
