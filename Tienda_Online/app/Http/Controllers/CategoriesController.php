<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Str;



class CategoriesController extends Controller
{
    public function getCategories($module){
        $categories = Category::where('module',$module)->orderBy('name', 'asc')->get();
        $data = ['cats' => $categories];


        return view('admin.categories.home', $data);

        
    }

    public function postCategoryAdd(Request $request){
        $rules=[
            'name' => 'required',
        ];
        $message = [
            'name.required'=>"Es necesario introducir un nombre de categoría para crearla"
            ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        }else{
            $cat = new Category();
            $cat -> name= $request->input("name");
            $cat -> module = $request->input('module');
            $cat->slug = Str::slug($request->input("name")); // Generar el slug desde el nombre

            if ($cat->save()) {
            return redirect("/admin/categories/0")->with("mensaje", "La categoria se ha añadido correctamente")->with('typealert', 'success');  
        
            }
        }

    }
        
        public function getCategoryEdit($id){

            $cat = Category::find($id);
            $data = ['cat' => $cat];
            return view('admin.categories.edit', $data);

        }

        public function postCategoryEdit(Request $request, $id){
            $rules=[
                'name' => 'required',
            ];
            $message = [
                'name.required'=>"Es necesario introducir un nombre de categoría para crearla"
                ];
    
            $validator = Validator::make($request->all(), $rules, $message);
            if($validator->fails()){
                return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
            }else{
                $cat = Category::find($id);
                $cat -> name= $request->input('name');
                $cat -> module = $request->input('module');
                if ($cat->save()) {

                    return back();
                }
            }
    
        }
        

        public function getCategoryDelete($id){
            $cat = Category::find($id);
            if ($cat->delete()) {

                return back();
            }


        }


}
