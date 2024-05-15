<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckSubunitDataRequest;
use App\Models\Truck;
use App\Models\TruckSubunit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TruckSubunitController extends Controller
{
	public function store(TruckSubunitDataRequest $request): JsonResponse
    {
		$validated = $request->validated();

		if ($validated['main_truck'] == $validated['subunit'])
		{
			return response()->json(['message' => 'Truck can not be subunit for itself'], 400);
		}

		// check if trucks exist
		$main_truck = Truck::findOrFail($validated['main_truck']);
		$subunit = Truck::findOrFail($validated['subunit']);

		$main_truck_subunits = TruckSubunit::where('main_truck', $validated['main_truck'])->get();

		// check that subunit dates don't overlap
		foreach ($main_truck_subunits as $key => $main_truck_subunit) {
			if (($validated['end_date'] >= $main_truck_subunit['start_date']) && ($main_truck_subunit['end_date'] >= $validated['start_date'])) {
				return response()->json(['message' => 'Selected date range overlaps with another subunit date for this truck'], 400);
			}
		}
		
		$subunit_for_trucks = TruckSubunit::where('subunit', $validated['main_truck'])->get();

		// don't let assign subunits for a busy subunit
		foreach ($subunit_for_trucks as $key => $subunit_for_truck) {
			if (($validated['end_date'] >= $subunit_for_truck['start_date']) && ($subunit_for_truck['end_date'] >= $validated['start_date'])) {
				return response()->json(['message' => 'Cannot assign subunit for this truck, because it is already a subunit for another truck at selected date range'], 400);
			}
		}
		
        TruckSubunit::create($request->validated());

        return response()->json(['message' => 'Subunit created']);
    }

	public function show($id): JsonResponse
    {
		// Probably a better idea is to use Many-to-Many relationship

		$main_truck_subunits = TruckSubunit::where('main_truck', $id)->get();

		foreach ($main_truck_subunits as $key => $subunit) {
			$truck = Truck::find($subunit->subunit);
		
			$subunit->unit_number = $truck->unit_number;
		}

        return response()->json($main_truck_subunits);
    }

	public function destroy($id): JsonResponse
    {
        TruckSubunit::findOrFail($id)->delete();

        return response()->json(['message' => 'Subunit deleted']);
    }
}
