<?php

namespace App\Http\Controllers;

use App\CategoryWork;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryWork\StoreRequest;
use App\Http\Requests\CategoryWork\UpdateRequest;

class CategoryWorkController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:categorieswork.create')->only(['create','store']);
        $this->middleware('can:categorieswork.index')->only(['index']);
        $this->middleware('can:categorieswork.edit')->only(['edit','update']);
        $this->middleware('can:categorieswork.show')->only(['show']);
        $this->middleware('can:categorieswork.destroy')->only(['destroy']);
    }

    public function index()
    {
        //Listado de Categorias
        $categoriesworks= CategoryWork::get();
        return view('admin.categorywork.index', compact('categoriesworks'));

    }

 
    public function create()
    {
        return view('admin.categorywork.create');
    }


    public function store(StoreRequest $request)
    {
        //dd($request->description);
        CategoryWork::create($request->all());
      
        return redirect()->route('categorieswork.index');
    }

 
    public function show(CategoryWork $categoryWork)
    {
        
    }


    public function edit(CategoryWork $categorywork)
    {
  
       //dd($categorywork);
       return view('admin.categorywork.edit', compact('categorywork'));
    }


    public function update(UpdateRequest $request, CategoryWork $categorywork)
    {
        $categorywork->update($request->all());
        return redirect()->route('categorieswork.index');
    }

   
    public function destroy(CategoryWork $categorywork)
    {
        

        //dd($categorywork);
         $categorywork->delete();
        //$data = Category::onlyTrashed()->get();
        //dd($data);

        return redirect()->route('categorieswork.index');

    }
}
