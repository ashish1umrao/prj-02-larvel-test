<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carsModel = DB::select(DB::raw("CALL SelectCarModels"));
        return view('cars_model.index', ['CarModel' => $carsModel]);
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : Create
     * *** FUNCTION PURPOSE : This Function Used For Only Create For a view
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cars = DB::select(DB::raw("CALL SelectAllCars"));
        return view('cars_model.create', ['cars' => $cars]);
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : store
     * *** FUNCTION PURPOSE : This Function Used For Store All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'model_name' => 'required|unique:cars_model',
            'cars' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // FOR IMAGE UPLOAD

        $imageName = time() . '.' . $request->model_name . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        $carData = explode("__", $request->cars);
        $carId = $carData['0'];
        $carName = $carData['1'];
        //echo $carId.'--'.$carName; die;

        $car = CarModel::create([
            'model_name' => $request->input('model_name'),
            'car_id' => $carId,
            'car_name' => $carName,
            'model_image' => $imageName,
        ]);
        return redirect()->back()->with('status', 'Data Added Successfully');
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : show
     * *** FUNCTION PURPOSE : This Function Used For Show All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/
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

    /****************************************************************************************
     * *** FUNCTION NAME    : edit
     * *** FUNCTION PURPOSE : This Function Used For edit All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['cars'] = DB::select(DB::raw("CALL SelectAllCars"));
        $data['carModel'] = CarModel::find($id);
        return view('cars_model.edit')->with
            ('EditData', $data
        );
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : update
     * *** FUNCTION PURPOSE : This Function Used For update All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request); die;
        $request->validate([
            'model_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // FOR IMAGE UPLOAD

        $imageName = time() . '.' . $request->model_name . '.' . $request->image->extension();
        //echo $imageName; die;
        $request->image->move(public_path('images'), $imageName);

        $carData = explode("__", $request->cars);
        $carId = $carData['0'];
        $carName = $carData['1'];
        //If its valid, it will process
        //If its Not valid, throw validationException
        $car = CarModel::where('id', $id)
            ->update([
                'model_name' => $request->input('model_name'),
                'car_id' => $carId,
                'car_name' => $carName,
                'model_image' => $imageName,
            ]);
        return redirect()->back()->with('status', 'Data Updated Successfully');
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : destroy
     * *** FUNCTION PURPOSE : This Function Used For delete Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 12 OCT 2021
     ***************************************************************************************/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = CarModel::find($id);
        $student->delete();
        return redirect()->back()->with('status', 'Data Deleted Successfully');
    }
}
