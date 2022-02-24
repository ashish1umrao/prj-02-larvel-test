<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
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
        $cars =  DB::select(DB::raw("CALL SelectAllCars"));      
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
    { //echo "<pre>"; print_r($request); die; 
        
        $request->validate([
                'name'          => 'required|unique:cars',
                'founded'       =>  'required|integer|min:0|max:2050',
                'description'   => 'required',
                'image'         => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        // FOR IMAGE UPLOAD

        $imageName = time().'.'.$request->image->extension();  
     
        $request->image->move(public_path('images'), $imageName);

        //If its valid, it will process
       //If its Not valid, throw validationException
        $car    = Car::create([
            'name'         => $request->input('name'),
            'founded'      => $request->input('founded'),
            'description'  => $request->input('description'),
            'car_image'    => $imageName
        ]);
       return redirect()->back()->with('status','Data Added Successfully');

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
        return view('cars.show')->with('car',$car);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {   

        $car = Car::find($id);
        return view('cars.edit')->with('EditData', $car);
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
        //FOR IMAGE UPLOAD
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);
        
        $car    =  Car::where('id',$id)
        ->update([
                'name'          =>   $request->input('name'),
                'founded'       =>   $request->input('founded'),
                'description'   =>   $request->input('description'),
                'car_image'     =>   $imageName,
                ]);
        return redirect()->back()->with('status','Data Updated Successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Car::find($id);
        $student->delete();
        return redirect()->back()->with('status','Data Deleted Successfully');
    }     

}
