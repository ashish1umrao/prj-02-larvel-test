<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Product;
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
    { 
        
        $request->validate([
                'name'          => 'required|unique:cars',
                'founded'       =>  'required|integer|min:0|max:2050',
                'description'   => 'required'

        ]);

        //If its valid, it will process
       //If its Not valid, throw validationException
        $car    = Car::create([
            'name'         => $request->input('name'),
            'founded'      => $request->input('founded'),
            'description'  => $request->input('description')
        ]);
       
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
        $car = Car::find($id);
        $products = Product::find($id); 
        //print_r($products);
        return view('cars.show')->with('car',$car);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $car = Car::find($id);
        
       
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

     public function forgotPassword(Request $request)
     {
        return view ('hello forget passowrd');
     }


}
