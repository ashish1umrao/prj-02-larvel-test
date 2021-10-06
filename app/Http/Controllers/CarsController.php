<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //GET ALL DATA
        $cars = Car::all()->toArray();
        //echo "<pre>"; var_dump($cars); die;
        //$cars = Car::where('name','=','AUDI')
        //->get();
        //dd($cars);
        return view('cars.index', [
            'cars' => $cars
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ADDEDIT PAGE DATA
        return view('cars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { //echo "<pre>"; print_r($request);
        $car = new Car;
        $car->name          = $request->input('name');
        $car->founded       = $request->input('founded');
        $car->description   = $request->input('description');
        $car->save();
       return redirect('/cars');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $car = Car::find($id)->first();
        //dd($id);
        return view('cars.edit')->with
            ('EditData', $car
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $car =  Car::where('id',$id)
        ->update([
                'name'          =>   $request->input('name'),
                'founded'       =>   $request->input('founded'),
                'description'   =>   $request->input('description'),
        ]);
        return redirect('/cars');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();

        return redirect('/cars');
    }
}
