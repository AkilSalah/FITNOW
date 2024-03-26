<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgressionRequest;
use App\Http\Resources\ProgresssionResource;
use App\Models\progression;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProgressionController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 
            ProgresssionResource::collection(
                progression::where('userId', '=', Auth::user()->id)->get()
            );
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgressionRequest $request)
    {
        $validation = $request->validated();

        $progression = progression::create([
            'userId' => Auth::user()->id,
            'poids' => $validation['poids'],
            'Poitrine' => $validation['Poitrine'],
            'Mollet' => $validation['Mollet'],
            'Bras' => $validation['Bras'],
            'Hauteur' => $validation['Hauteur'],
            'PoidsLeve' => $validation['PoidsLeve'],
            'TempsDeCourse' => $validation['TempsDeCourse'],
        ]);
        return $this->success([
            'message' => 'Success',
            'Progression' => new ProgresssionResource($progression),
        ]);

    }
        // return new ProgresssionResource($progression);

    /**
     * Display the specified resource.
     */
    public function show(progression $progression)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(progression $progression)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, progression $progression)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(progression $progression)
    {
        //
    }
}
