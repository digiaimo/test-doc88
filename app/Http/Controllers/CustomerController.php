<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return 'hello world';
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
    public function store(StoreCustomerRequest $request)
    {
        try {
            Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'complement' => isset($request->complement) ? $request->complement : null,
                'district' => $request->district,
                'cep' => $request->cep,
                'date_of_birth' => $request->date_of_birth,
            ]);

            return 'Cliente cadastrado com sucesso!';
        } catch (Exception $exception ) {
            return [
                "message" => 'Erro ao cadastrar cliente! ',
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
            $customer = Customer::findOrFail($id);
            return $customer;
        } catch (Exception $exception) {
            return 'Cliente não encontrado!';
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
    public function update(UpdateCustomerRequest $request, string $id)
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

            return 'Cliente atualizado com sucesso!';
        } catch (Exception $exception) {
            return [
                "message" => 'Erro ao atualizar cliente! ',
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
            $customer = Customer::findOrFail($id);
            $customer->delete();

            return 'Cliente excluído com sucesso!';
        } catch (Exception $exception) {
            return [
                "message" => 'Erro ao excluir cliente! ',
                "error" => $exception->getMessage()
            ];
        }
    }
}
