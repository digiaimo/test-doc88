<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAcquisitionsRequest;
use App\Mail\MailNotifyAcquisition;
use App\Models\Acquisition;
use App\Models\Customer;
use App\Models\Product;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class AcquisitionsController extends Controller
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
    public function store(StoreAcquisitionsRequest $request): JsonResponse
    {
        try{
            $customer = Customer::find($request->customer_id);

            if (is_null($customer)) {
                return response()->json(
                    'Cliente não encontrado! ',
                    Response::HTTP_BAD_REQUEST);
            }

            $product = Product::find($request->product_id);

            if (is_null($product)) {
                return response()->json(
                    'Produto não encontrado! ',
                    Response::HTTP_BAD_REQUEST);
            }

            $acquisition = Acquisition::create([
                'customer_id' => $request->customer_id,
                'product_id' => $request->product_id,
            ]);

            $data = [
                'name' => $customer->name,
                'product_name' => $product->name,
                'product_price' => $product->price,
            ];

            Mail::to($customer->email)->send(new MailNotifyAcquisition($data));

            return response()->json($acquisition, Response::HTTP_CREATED);
        }catch(Exception $exception){
            return response()->json(
                'Erro ao cadastrar pedido! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        try{
            $acquisition = Acquisition::findOrFail($id);

            return response()->json($acquisition, Response::HTTP_OK);
        }catch(Exception $exception){
            return response()->json(
                'Erro ao buscar pedido! ',
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $acquisition = Acquisition::findOrFail($id);

            $acquisition->delete();

            return response()->json([], Response::HTTP_NO_CONTENT);
        }catch(Exception $exception){
            return response()->json(
                'Erro ao excluir pedido! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
