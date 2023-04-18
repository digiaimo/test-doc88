<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(Response::HTTP_OK);
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
    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $path = $request->file('photo')->store('products');

            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'photo' => $path,
            ]);

            return response()->json($product, Response::HTTP_CREATED);
        } catch (Exception $exception ) {
            return response()->json(
                'Erro ao cadastrar produto! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            return response()->json($product, Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao buscar produto! ',
                Response::HTTP_BAD_REQUEST
            );
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
    public function update(UpdateProductRequest $request, string $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);


            $product->update([
                'name' => isset($request->name) ? $request->name : $product->name,
                'price' => isset($request->price) ? $request->price : $product->price,
                'photo' => isset($request->photo) ? $request->file('photo')->store('products') : $product->photo,
            ]);

            return response()->json($product, Response::HTTP_NO_CONTENT);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao atualizar produto! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $product = Product::findOrFail($id);

            $product->delete();

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao deletar produto! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
