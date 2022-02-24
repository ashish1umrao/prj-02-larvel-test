<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $CategoryData = DB::select(DB::raw("CALL SelectAllCategory"));
        return view('category.index', ['CategoryData' => $CategoryData]);
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : Create
     * *** FUNCTION PURPOSE : This Function Used For Only Create For a view
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 18 OCT 2021
     ***************************************************************************************/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $Category = DB::select(DB::raw("CALL SelectAllCategory"));
        return view('category.create', ['CategoryData' => $Category]);
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : store
     * *** FUNCTION PURPOSE : This Function Used For Store All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 18 OCT 2021
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
            'category_name' => 'required|unique:category',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // FOR IMAGE UPLOAD

        $imageName = time() . '.' . $request->model_name . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $Category = CategoryModel::create([
            'category_name' => $request->input('category_name'),
            'category_image' => $imageName,
        ]);
        return redirect()->back()->with('status', 'Data Added Successfully');
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : show
     * *** FUNCTION PURPOSE : This Function Used For Show All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 18 OCT 2021
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
     * *** CREATED DATA     : 18 OCT 2021
     ***************************************************************************************/
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $category = CategoryModel::find($id);
        return view('category.edit')->with('EditData', $category);
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : update
     * *** FUNCTION PURPOSE : This Function Used For update All Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 18 OCT 2021
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
        $request->validate([
            'category_name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // FOR IMAGE UPLOAD
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        //If its valid, it will process
        //If its Not valid, throw validationException
        $car = CategoryModel::where('id', $id)
            ->update([
                'category_name' => $request->category_name,
                'category_image' => $imageName,
            ]);
        return redirect()->back()->with('status', 'Data Updated Successfully');
    }

    /****************************************************************************************
     * *** FUNCTION NAME    : destroy
     * *** FUNCTION PURPOSE : This Function Used For delete Data
     * *** CREATED BY       : Ashish UMrao
     * *** CREATED DATA     : 18 OCT 2021
     ***************************************************************************************/
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = CategoryModel::find($id);
        $student->delete();
        return redirect()->back()->with('status', 'Data Deleted Successfully');
    }
}
