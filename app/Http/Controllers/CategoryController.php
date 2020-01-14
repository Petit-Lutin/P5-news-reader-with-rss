<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
//    public function index()
//    {
//        $categories = Category::orderBy('name')->get();
////        return view('index', compact('flows'));
////        return view('index')
////            ->withFlows($flows)
////            ->withSuperTruc('bonjour');
//        return 'olala';
//    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('categories/create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->all());
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
        $category = null;
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage(); //plus tard faire une vue d'erreur
            die();
        }
        return view('categories/edit')->withCategory($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $exception) {
            echo $exception->getMessage(); //plus tard faire une vue d'erreur
            die();
        }
        $category->name=$request->input("name");
        $category->save();
//        echo "enregistrer";
//        dd("enregistrer");
//        return view('categories/edit')->withCategory($category);
        return redirect('/index');

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
