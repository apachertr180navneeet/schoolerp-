<?php

namespace App\Http\Controllers\Backend\Transport;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TransportVehicle;
use App\Models\TransportRoute;
use App\Models\StudentTransport;
use App\Models\User;

class TransportController extends Controller
{
    // Vehicles
    public function VehicleView()
    {
        $allData = TransportVehicle::with('route')->orderBy('id', 'DESC')->get();
        return view('backend.transport.vehicle_view', compact('allData'));
    }

    public function VehicleAdd()
    {
        $routes = TransportRoute::all();
        return view('backend.transport.vehicle_add', compact('routes'));
    }

    public function VehicleStore(Request $request)
    {
        $request->validate([
            'vehicle_number' => 'required|unique:transport_vehicles,vehicle_no',
            'capacity' => 'required|numeric',
        ]);

        TransportVehicle::create([
            'vehicle_no' => $request->vehicle_number,
            'vehicle_model' => $request->vehicle_model,
            'driver_name' => $request->driver_name ?? 'Driver',
            'driver_phone' => $request->driver_phone ?? '',
            'driver_license' => $request->driver_license,
            'capacity' => $request->capacity,
        ]);

        $notification = [
            'message' => 'Transport Vehicle Added Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('transport.vehicle.view')->with($notification);
    }

    public function VehicleEdit($id)
    {
        $editData = TransportVehicle::findOrFail($id);
        $routes = TransportRoute::all();
        return view('backend.transport.vehicle_edit', compact('editData', 'routes'));
    }

    public function VehicleUpdate(Request $request, $id)
    {
        $vehicle = TransportVehicle::findOrFail($id);
        $request->validate([
            'vehicle_number' => 'required|unique:transport_vehicles,vehicle_no,' . $vehicle->id,
            'capacity' => 'required|numeric',
        ]);

        $vehicle->update([
            'vehicle_no' => $request->vehicle_number,
            'vehicle_model' => $request->vehicle_model,
            'driver_name' => $request->driver_name ?? $vehicle->driver_name,
            'driver_phone' => $request->driver_phone ?? $vehicle->driver_phone,
            'driver_license' => $request->driver_license,
            'capacity' => $request->capacity,
        ]);

        $notification = [
            'message' => 'Vehicle Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('transport.vehicle.view')->with($notification);
    }

    public function VehicleDelete($id)
    {
        TransportVehicle::findOrFail($id)->delete();
        $notification = [
            'message' => 'Vehicle Deleted Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('transport.vehicle.view')->with($notification);
    }

    // Routes
    public function RouteView()
    {
        $allData = TransportRoute::orderBy('id', 'DESC')->get();
        return view('backend.transport.route_view', compact('allData'));
    }

    public function RouteAdd()
    {
        return view('backend.transport.route_add');
    }

    public function RouteStore(Request $request)
    {
        $request->validate([
            'route_title' => 'required|unique:transport_routes,route_name',
            'fare' => 'required|numeric',
        ]);

        TransportRoute::create([
            'route_name' => $request->route_title,
            'start_point' => $request->start_point,
            'end_point' => $request->end_point,
            'fare' => $request->fare,
        ]);

        $notification = [
            'message' => 'Transport Route Created Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('transport.route.view')->with($notification);
    }

    public function RouteEdit($id)
    {
        $editData = TransportRoute::findOrFail($id);
        return view('backend.transport.route_edit', compact('editData'));
    }

    public function RouteUpdate(Request $request, $id)
    {
        $route = TransportRoute::findOrFail($id);
        $request->validate([
            'route_title' => 'required|unique:transport_routes,route_name,' . $route->id,
            'fare' => 'required|numeric',
        ]);

        $route->update([
            'route_name' => $request->route_title,
            'start_point' => $request->start_point,
            'end_point' => $request->end_point,
            'fare' => $request->fare,
        ]);

        $notification = [
            'message' => 'Route Updated Successfully',
            'alert-type' => 'info'
        ];

        return redirect()->route('transport.route.view')->with($notification);
    }

    public function RouteDelete($id)
    {
        TransportRoute::findOrFail($id)->delete();
        $notification = [
            'message' => 'Route Deleted Successfully',
            'alert-type' => 'info'
        ];
        return redirect()->route('transport.route.view')->with($notification);
    }

    // Student Transport Allocation
    public function StudentTransportView()
    {
        $allData = StudentTransport::with(['student', 'route'])->orderBy('id', 'DESC')->get();
        return view('backend.transport.student_transport_view', compact('allData'));
    }

    public function StudentTransportAdd()
    {
        $students = User::where('usertype', 'Student')->get();
        $routes = TransportRoute::all();
        $vehicles = TransportVehicle::all();
        return view('backend.transport.student_transport_add', compact('students', 'routes', 'vehicles'));
    }

    public function StudentTransportStore(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'route_id' => 'required',
        ]);

        StudentTransport::updateOrCreate(
            ['student_id' => $request->student_id],
            [
                'route_id' => $request->route_id,
                'pickup_point' => $request->pickup_point,
                'monthly_fare' => $request->monthly_fee ?? 0,
            ]
        );

        $notification = [
            'message' => 'Student Transport Assigned Successfully',
            'alert-type' => 'success'
        ];

        return redirect()->route('transport.student.view')->with($notification);
    }

    public function StudentTransportDelete($id)
    {
        StudentTransport::findOrFail($id)->delete();
        $notification = [
            'message' => 'Student Transport Assignment Removed',
            'alert-type' => 'info'
        ];
        return redirect()->route('transport.student.view')->with($notification);
    }
}
