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
        return $this->success([
            'progressions' => ProgresssionResource::collection(
                progression::where('userId', '=', Auth::user()->id)->orderBy('created_at' , 'desc')->get()
            ),
        ]);
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
            'status' => 'NonTerminé',
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
    public function show($id)
    {
        $progression = progression::find($id);
        if (!$progression) {
            return $this->error('', 'Progression not found', 404);
        }
        if(Auth::user()->id !== $progression->userId){
            return $this->error('', 'Unauthorized', 403);
        }   
        return new ProgresssionResource($progression);
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
    public function update(Request $request, $id)
    {
        $progression = progression::find($id);
        if (!$progression) {
            return $this->error('', 'Progression not found', 404);
        }
        if(Auth::user()->id !== $progression->userId){
            return $this->error('', 'Unauthorized', 403);
        }   

        $progression->update($request->all());

        return new ProgresssionResource($progression);
    }

    public function Termine($id)
    {
        $progression = progression::find($id);
        if (!$progression) {
            return $this->error('', 'Progression not found', 404);
        }
        if(Auth::user()->id !== $progression->userId){
            return $this->error('', 'Unauthorized', 403);
        }   

        $progression->update([
            'status' => 'terminé',
        ]);

        return $this->success([
            'message' => 'completed',
            'progression' => new ProgresssionResource($progression),
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $progression = progression::find($id);
        if (!$progression) {
            return $this->error('', 'Progression not found', 404);
        }
        if(Auth::user()->id !== $progression->userId){
            return $this->error('', 'Unauthorized', 403);
        }   
        $progression->delete();
        return $this->success([
            'message' => 'Progression deleted successfully',
        ]);
    }

    // private function ProgressionCheck($id){

    //     $progression = progression::find($id);
    //     if (!$progression) {
    //         return $this->error('', 'Progression not found', 404);
    //     }
    //     if(Auth::user()->id !== $progression->userId){
    //         return $this->error('', 'Unauthorized', 403);
    //     }   
    //     return $progression;
    // }
}
