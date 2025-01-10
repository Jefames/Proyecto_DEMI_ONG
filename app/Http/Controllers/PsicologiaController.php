<?php

 namespace App\Http\Controllers;

 use App\Models\Psicologia;
 use Illuminate\Http\Request;

 class PsicologiaController extends Controller
 {
     /**
      * Display a listing of the resource.
      */
     public function index()
     {
         //
     }

     /**
      * Show the form for creating a new resource.
      */
     public function create()
     {
         return view('services.psicologia.create');
     }

     /**
      * Store a newly created resource in storage.
      */
     public function store(Request $request)
     {
         //
     }

     /**
      * Display the specified resource.
      */
     public function show(Psicologia $psicologia)
     {
         //
     }

     /**
      * Show the form for editing the specified resource.
      */
     public function edit(Psicologia $psicologia)
     {
         //
     }

     /**
      * Update the specified resource in storage.
      */
     public function update(Request $request, Psicologia $psicologia)
     {
         //
     }

     /**
      * Remove the specified resource from storage.
      */
     public function destroy(Psicologia $psicologia)
     {
         //
     }
 }
