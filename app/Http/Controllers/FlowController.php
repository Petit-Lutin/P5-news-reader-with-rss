<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use Illuminate\Http\Request;
use App\Http\Requests\FlowRequest;
use Illuminate\Support\Facades\Auth;

class FlowController extends Controller
{
    public function __construct()
    {
//      On doit être identifié pour pouvoir interagir avec les flux RSS
        $this->middleware('auth', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $flows = Flow::orderBy('name')->get();
        $user = Auth::user();
        $categories = $user->categoriesOrderBy;
//        dd($categories);
//        $categories = Category::orderBy('name')->get();
        foreach ($categories as $category) {
            $category->flows;
        }
        return view('index')
//            ->withFlows($flows)
            ->withCategories($categories)
            ->withJsonCategories(json_encode($categories));
//            ->withSuperTruc('bonjour');
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
        $inputs = $request->all();
        if ($request->input('category_id') == '-1') {
            $category = Category::create(['name' => $request->input('category_name')]);
            $inputs ['category_id'] = $category->id;
        }
//        dd($inputs);
        $flow = Flow::create($inputs);
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) // id
    {
        $flow = Flow::find($id)->get();
////        return view('flows/show', compact('flow'))
        return View::make('flows/show')
            ->with('flow', $flow);
//
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $categories = Category::orderBy('name')->get();

        $flow = null;
        try {
            $flow = Flow::findOrFail($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage(); //todo: plus tard faire une vue d'erreur
            die();
        }
        return view('flows/edit')
            ->withFlow($flow)
            ->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(FlowRequest $request, $id)
    {
        try {
            $flow = Flow::findOrFail($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage(); //todo: faire une vue d'erreur
            die();
        }
        $inputs = $request->all();
        if ($request->input('category_id') == '-1') {
            $category = Category::create(['name' => $request->input('category_name')]);
            $inputs ['category_id'] = $category->id;
        }
//        dd($inputs);
//        $flow = Flow::create($inputs);
//        $flow->name=$inputs['name'];
//        $flow->name=$inputs['name'];
//        $flow->name=$inputs['name'];
        $flow->name = $inputs["name"];
        $flow->url = $inputs["url"];
        $flow->category_id = $inputs["category_id"];
        $flow->save();

        return redirect('/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //public function destroy(Film $film)
        $flow = Flow::findOrFail($id);
        $flow->delete();
        return back()->with('info', 'Le flux a bien été supprimé dans la base de données.');
    }
}
