<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Listagem de produtos";
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
    public function store(StoreProductRequest $request)
    {
        try {
            $path = $request->file('photo')->store('products');

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'photo' => $path,
            ]);

            return 'Produto cadastrado com sucesso!';
        } catch (Exception $exception ) {
            return [
                "message" => 'Erro ao cadastrar produto! ',
                "error" => $exception->getMessage()
            ];
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            return $product;
        } catch (Exception $exception) {
            return 'Produto não encontrado!';
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        try {
            $product = Product::findOrFail($id);


            $product->update([
                'name' => isset($request->name) ? $request->name : $product->name,
                'price' => isset($request->price) ? $request->price : $product->price,
                'photo' => isset($request->photo) ? $request->file('photo')->store('products') : $product->photo,
            ]);

            return 'Produto atualizado com sucesso!';
        } catch (Exception $exception) {
            return [
                "message" => 'Erro ao atualizar produto! ',
                "error" => $exception->getMessage()
            ];
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $product->delete();

            return 'Produto excluído com sucesso!';
        } catch (Exception $exception) {
            return [
              "message" => 'Erro ao excluir produto! ',
              "error" => $exception->getMessage()
            ];
        }
    }
}
