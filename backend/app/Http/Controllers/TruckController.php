<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckDataRequest;
use App\Http\Resources\TruckResource;
use App\Models\Truck;
use App\Models\TruckSubunit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Truckresource::collection(Truck::all()));
    }

    public function store(TruckDataRequest $request): JsonResponse
    {
        Truck::create($request->validated());

        return response()->json(['message' => 'Truck created']);
    }

    public function update(TruckDataRequest $request, Truck $truck): JsonResponse
    {
        $truck->update($request->validated());

        return response()->json(['message' => 'Truck updated']);
    }

    public function show(Truck $truck): JsonResponse
    {
		$truck->trucks = Truck::whereNotIn('id', [$truck->id])->get();
        return response()->json(new TruckResource($truck));
    }

    public function destroy(Truck $truck): JsonResponse
    {
		TruckSubunit::where('main_truck', $truck->id)->delete();

        $truck->delete();

        return response()->json(['message' => 'Truck deleted']);
    }
}
