<?php

namespace App\Http\Controllers;

use App\Category;
use App\Flow;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {

    }

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
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $category = Category::create($data); //on vérifie que l'utilisateur est bien connecté pour qu'il ne voie que les catégories qui lui appartiennent
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
        $category->name = $request->input("name");
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
        $user = Auth::user();
        $categories = $user->categoriesOrderBy;
        $category = Category::findOrFail($id);

        $flows = $category->flows();
        if ($flows!=null){
            foreach ($flows as $flow) {
                $flow->delete();
            }
        }

        $category->delete();
        // For many relations:
//        if ( $model->relation->isEmpty() ) {
//            // ...
//        }
//        if ($flows->count()==0) {

//           dd($category);
        return back()->with('info', 'La catégorie a bien été supprimée dans la base de données.');
//        }
        return redirect('/index');
//

    }
}
