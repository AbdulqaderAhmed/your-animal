<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Animal;

class AnimalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ani = Animal::all();
        return response()->json(["animal"=>$ani], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        $user_id = auth()->user()->id;
        
        $request->validate([
        	"type" => "required|string",
        	"color" => "required|string",
        	"legs" => "required|string",
        ]);
        
        $ani = new Animal();
        $ani->type = $request->input("type");
        $ani->user_id = $user_id;
        $ani->color = $request->input("color");
        $ani->legs = $request->input("legs");
        $ani->save();
        
        return response()->json([
        	"success" => true,
        	"message" => "Animal created successfully.",
        	"animal" => $ani
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Animal $animal)
    {
        //
        $this->authorize('view', $animal);
        
        $ani = Animal::findorFail($id);
        return response()->json([
        	"success" => true,
        	"message" => "Animal retrived successfully.",
        	"animal" => $ani,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Animal $animal)
    {
        //
        $this->authorize('update', $animal);
        
        $user_id = auth()->user()->id;
        
        $request->validate([
        	"type" => "required|string",
        	"color" => "required|string",
        	"legs" => "required|string",
        ]);
        
        $ani = Animal::findorFail($id);
        $ani->type = $request->input("type");
        $ani->user_id = $user_id;
        $ani->color = $request->input("color");
        $ani->legs = $request->input("legs");
        $ani->save();
        
        return response()->json([
        	"success" => true,
        	"message" => "Animal updated successfully.",
        	"animal" => $ani
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Animal $animal)
    {
        //
        $this->authorize('delete', $animal);
        
        $ani = Animal::findorFail($id);
        $ani->delete();
        
        return response()->json([
        	"success" => true,
        	"message" => "Animal deleted successfully.",
        	"animal" => $ani
        ]);
    }
}