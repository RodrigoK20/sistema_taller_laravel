<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Unit\StoreRequest;
use App\Http\Requests\Unit\UpdateRequest;

class UnitController extends Controller
{
  
    public function index()
    {
        $units = Unit::get();
        return view('admin.unit.index', compact('units'));
    }

  
    public function create()
    {
        return view('admin.unit.create');
    }

  
    public function store(StoreRequest $request)
    {
        Unit::create($request->validated());
      
        return redirect()->route('units.index');
    }

  
    public function show(Unit $unit)
    {
         //Detalle categoria
         return view('admin.unit.show', compact('unit'));
    }


    public function edit(Unit $unit)
    {
        return view('admin.unit.edit', compact('unit'));
    }


    public function update(UpdateRequest $request, Unit $unit)
    {
        $unit->update($request->all());
        return redirect()->route('units.index');
    }


    public function destroy(Unit $unit)
    {
        $unit->delete();
    
        return redirect()->route('units.index');
    }
}
