<?php

namespace App\Http\Controllers;

use App\Workshop;
use App\CategoryWork;
use Illuminate\Http\Request;
use App\Http\Requests\Workshop\StoreRequest;
use App\Http\Requests\Workshop\UpdateRequest;

class WorkshopController extends Controller
{
  
    public function index()
    {
        $workshops= Workshop::get();
        return view('admin.workshop.index', compact('workshops'));
    }

 
    public function create()
    {
        $categories = CategoryWork::get();

        return view('admin.workshop.create', compact('categories'));
    }

 
    public function store(StoreRequest $request)
    {

        Workshop::create($request->validated());
      
        return redirect()->route('workshops.index');
    }

   
    public function show(Workshop $workshop)
    {
        return view('admin.workshop.show', compact('workshop'));
    }

 
    public function edit(Workshop $workshop)
    {
        //dd($workshop);
        //$id_cat = $workshop->category_work_id;
        //dd($id_cat);
        $categories = CategoryWork::get();
        
        return view('admin.workshop.edit', compact('categories','workshop'));
    }


    public function update(UpdateRequest $request, Workshop $workshop)
    {
    
        $workshop->update($request->all());
        return redirect()->route('workshops.index');
    }

    public function change_status(Workshop $workshop){
        
        if ($workshop->status =='ACTIVE') {
            $workshop->update(['status'=>'DEACTIVATED']);
            return redirect()->back();
        }

        else{
            $workshop->update(['status'=>'ACTIVE']);
            return redirect()->back();
        }

    }

    public function get_workshops_by_id(Request $request){
        if ($request->ajax()) {
            $workshops = Workshop::findOrFail($request->workshop_id);
            return response()->json($workshops);
        }

    }


    public function destroy(Workshop $workshop)
    {
        //
    }
}
