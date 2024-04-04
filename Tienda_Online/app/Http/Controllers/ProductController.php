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
    // Método para obtener la página principal de administración de productos
    public function getHome(){
        $products = Products::orderBy('id', 'desc')->paginate(25);
        $data = ['products' => $products];
        return view('admin.products.home', $data);
    }

    // Método para mostrar el formulario de agregar un nuevo producto
    public function getProductAdd(){
        $cat = Category::where('module', '0')->pluck('name','id');
        $data = ['cats' => $cat];
        return view('admin.products.add', $data);
    }

    // Método para procesar el formulario de agregar un nuevo producto
    public function postProductAdd(Request $request){
        // Validación de los campos del formulario
        $rules = [
            'name' => 'required',
            'img' => 'required ',
            'price' => 'required',
            'content' => 'required',
        ];
        $message = [
            'name.required' => 'El nombre del producto es requerido',
            'img.required' => 'Seleccione una imagen destacada',
            'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Ingrese una descripción del producto'
        ];
        
        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger')->withInput();
        }else{
            // Crear un nuevo producto
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

            // Guardar el nuevo producto en la base de datos
            if ($product->save()) {
                return redirect('/admin/products')->with("mensaje", "El producto se ha creado correctamente")->with('typealert', 'success');  
            }
        }
    }

    // Método para obtener la vista de edición de un producto
    public function getProductEdit($id){
        $p = Products::find($id);
        $cat = Category::where('module', '0')->pluck('name','id');
        $data = ['cats' => $cat, 'p' => $p];
        return view('admin.products.edit', $data);
    }
    
    // Método para procesar el formulario de edición de un producto
    public function postCategoryEdit(Request $request, $id){
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'content' => 'required',
        ];
        $message = [
            'name.required' => 'El nombre del producto es requerido',
            'price.required' => 'Ingrese el precio del producto',
            'content.required' => 'Ingrese una descripción del producto'
        ];

        $validator = Validator::make($request->all(), $rules, $message);
        if($validator->fails()){
            return back()->withErrors($validator)->with('message', 'Se ha producido un error')->with('typealert', 'danger');
        }else{
            // Encontrar el producto y actualizar sus datos
            $p = Products::find($id);
            $p->name = $request->input('name');
            $p->price = $request->input('price');
            $p->content = $request->input('content');

            // Guardar los cambios del producto
            if ($p->save()) {
                return back()->with('message', 'Producto actualizado correctamente')->with('typealert', 'success');
            } else {
                return back()->with('message', 'Error al actualizar el producto')->with('typealert', 'danger');
            }
        }
    }

    // Método para eliminar un producto
    public function getProductDelete($id){
        $p = Products::find($id);
        if ($p->delete()) {
            return back();
        }
    }
}
