<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
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
    public function store(StoreCustomerRequest $request): JsonResponse
    {
        try {
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'complement' => isset($request->complement) ? $request->complement : null,
                'district' => $request->district,
                'cep' => $request->cep,
                'date_of_birth' => $request->date_of_birth,
            ]);

            return response()->json($customer, Response::HTTP_CREATED);
        } catch (Exception $exception ) {
            return response()->json(
                'Erro ao cadastrar cliente! ',
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
            $customer = Customer::findOrFail($id);
            
            return response()->json($customer, Response::HTTP_OK);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao buscar cliente! ',
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
    public function update(UpdateCustomerRequest $request, string $id): JsonResponse
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->update([
                'name' => isset($request->name) ? $request->name : $customer->name,
                'email' => isset($request->email) ? $request->email : $customer->email,
                'phone' => isset($request->phone) ? $request->phone : $customer->phone,
                'address' => isset($request->address) ? $request->address : $customer->address,
                'complement' => isset($request->complement) ? $request->complement : null,
                'district' => isset($request->district) ? $request->district : $customer->district,
                'cep' => isset($request->cep) ? $request->cep : $customer->cep,
                'date_of_birth' => isset($request->date_of_birth) ? $request->date_of_birth : $customer->date_of_birth,
            ]);

            return response()->json($customer, Response::HTTP_NO_CONTENT);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao atualizar cliente! ',
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
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return response()->json([], Response::HTTP_NO_CONTENT);
        } catch (Exception $exception) {
            return response()->json(
                'Erro ao deletar cliente! ',
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
