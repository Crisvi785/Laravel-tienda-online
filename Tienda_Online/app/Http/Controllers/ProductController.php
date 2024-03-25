<?php

namespace App\Http\Controllers;

use App\Http\Models\Category;
use App\Http\Models\Products;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 
use Illuminate\Support\Str;



class ProductController extends Controller
{

   
    public function getHome(){
        $products = Products::orderBy('id', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    public function getProductAdd(){
        $cat = Category::where('module', '0')->pluck('name','id');
        $data = ['cats' => $cat];
        return view('admin.products.add', $data);
    }

    public function postProductAdd(Request  $request){
        $rules = [
            'name' => 'required',
            'img' => 'required ',
            'price' => 'required',
            'content' => 'required',
        ];
       $message =[
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Seleccione una imagen destacada',
            // 'img.image' => 'El archivo no es una imagen',
            'price.required' => 'Ingrece el precio del producto',
            'content.required' => 'Ingrese una descripcion del producto'
        ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        }else{

            $product = new Products();
            $product->status = '0';
            $product->name = $request->input('name');
            $product->category_id = $request->input('category');
            $product->image ='image.png';
            $product->price = $request->input('price');
            $product->in_discount = $request->input('indiscount');
            $product->discount = $request->input('discount');
            $product->content = $request->input('content');
            $product->slug = Str::slug($request->input('name'));


            if ($product->save()) {
                return redirect('/admin/products')->with("mensaje", "El producto se ha creado correctamente")->with('typealert', 'success');  
            
            }

        }
    }
    

    public function getProductEdit($id){
        $p = Products::find($id);
        $cat = Category::where('module', '0')->pluck('name','id');
        $data = ['cats' => $cat, 'p' => $p];
    return view('admin.products.edit', $data);
    }
    
    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required',
        ];
       $message =[
            'name.required' => 'El nombre del producto es requerido',
            'price.required' => 'Ingrece el precio del producto',
            'content.required' => 'Ingrese una descripcion del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        }else{
            $p = Products::find($id);
            $p->name = $request->input('name');
            $p->price = $request->input('price');
            $p->content = $request->input('content');

            // Guarda el nuevo producto
            if ($p->save()) {
                return back()->with('message', 'Producto actualizado correctamente')->with('typealert', 'success');
            } else {
                return back()->with('message', 'Error al actualizar el producto')->with('typealert', 'danger');
            }
        }

    }






    public function getProductDelete($id){
        $p = Products::find($id);
        if ($p->delete()) {

            return back();
        }


    }
}

