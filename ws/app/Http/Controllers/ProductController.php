<?php


/**
 *  DESENVOLVEDOR ELVIS ARAUJO E JOCLEITON PAIXÃO
 *  INSTITUIÇÃO : UNIME LAURO DE FREITAS
 *  CURSO: SISTEMAS DE INFORMAÇÃO 6° SEMESTRE
 */
namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $products  =  ProductResource::collection(Product::all());
            return response()->json($products,200);

        }catch(Exception $e){
             return response()->json($e->getMessage(),204);
        }

    }

    public function filter(Request $request)
    {
        try {
            $products  =  Product::where('name',$request->search)->first();
            return response()->json($products,200);

        }catch(Exception $e){
             return response()->json($e->getMessage(),204);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $slug = Str::slug($request->name);
        $slug_count = Product::where('slug',$slug)->count();

        if($slug_count > 0){
            $slug .= time().'-'.$slug;
        }
        $data['slug'] = $slug;
        $response = Product::create($data);
        if($response){
            return response()->json('Produto Criado com sucesso!',200);
        }
        return response()->json('Falha ao criar produto',400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        $data = $request->except('_token');
        try{
            $product =  Product::findOrFail($id);
            $status = $product->fill($data)->save();
            if($status){
                return response()->json('Produto Atualizado com sucesso!',200);
            }

        }catch(Exception $e){
            return response()->json($e->getMessage(),400);
        }



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        try {
            $product->delete();
            return response()->json('Produto Excluido com sucesso!',204);

        }catch (\Exception $e){

        }
    }
}
