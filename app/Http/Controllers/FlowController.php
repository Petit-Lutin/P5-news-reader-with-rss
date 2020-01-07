<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use Illuminate\Http\Request;
use App\Http\Requests\FlowRequest;

class FlowController extends Controller
{
    public function __construct()
    {
//        parent::__construct();
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flows = Flow::orderBy('name')->get();
//        return view('index', compact('flows'));
        return view('index')
            ->withFlows($flows)
            ->withSuperTruc('bonjour');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('flows/create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlowRequest $request)

    {
//        $flow=new Flow($request->all());
//        $flow->save();
        $flow = Flow::create($request->all());
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
