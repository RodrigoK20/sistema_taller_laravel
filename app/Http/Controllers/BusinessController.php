<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
use App\Http\Requests\Business\UpdateRequest;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:business.index')->only(['index']);
        $this->middleware('can:business.edit')->only(['update']);
    }


    public function index(){

        $business = Business::where('id',1)->firstOrFail();
        return view('admin.business.index', compact('business'));
    }

    public function update(Request $request, Business $business)
    {

      
         //Imagen fotografia
          if($request->hasFile('picture')){
            $file = $request->file('picture');
            $image_name = time().'_'.$file->getClientOriginalName();
            $file->move(public_path("/image"),$image_name);
        
                
        $business->update($request->all()+[
            'logo'=> $image_name,
           
        ]);

        //Actualizar telefono
        $data = Business::find(1);
        $data->phone = $request->phone;
        $data->save();

        
    }

       else {
        $business->update($request->all());

        //Actualizar telefono
        $data = Business::find(1);
        $data->phone = $request->phone;
        $data->save();


       }

        return redirect()->route('business.index');
    }
}
