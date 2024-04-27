<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Cuisin;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $model;
    protected $json;
    protected $title;
    protected $page;
    protected $limit = 50;
    protected $upload;

    protected $user;

    public function __construct(Request $request) {
        $this->user = $request->user;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cuisin = request('cuisin');

        if ($cuisin) {
            $cuisin = Cuisin::where('name', $cuisin)->first();
        }
        return $this->model->when(($cuisin), function($q) use($cuisin) {
            return $q->where('cuisin_id',$cuisin->id);
        })->latest()->paginate($this->limit);
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
    public function show(string $id)
    {
        return $this->model->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->model->find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->model->find($id)->delete();
    }

    public function favorites()
    {
        return $this->model->inRandomOrder()->take(5)->get();
    }
}
