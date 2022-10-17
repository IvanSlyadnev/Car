<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Http\Requests\CarReserveRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CarController extends Controller
{
    public function index () {
        $this->authorize('viewAny', new Car);
        return Car::all();
    }

    public function create() {
        $this->authorize('create', new Car);

        return [
            'car' => new Car,
            'fields' => (new Car())->getFillable()
        ];
    }

    public function store(CarRequest $request) {
        $this->authorize('create', new Car);

        $car = Car::create($request->only((new Car())->getFillable()));
        return redirect()->route('car.edit', ['car' => $car->id])->with('status', 'Автомобиль создан');
    }

    public function edit(Car $car) {
        $this->authorize('update', $car);

        return [
            'car' => $car
        ];
    }

    public function show(Car $car) {
        return $car->load('users');
    }

    public function update(CarRequest $request, Car $car) {
        $this->authorize('update', $car);

        $car->update($request->only($car->getFillable()));

        return redirect()->route('car.edit', ['car' => $car->id])->with('status', 'Автомобиль обновлен');
    }

    public function destroy (Car $car) {
        $this->authorize('delete', $car);

        $car->delete();

        return redirect()->route('car.index')->with('status', 'Автомобиль удален');
    }

    public function restore(Car $car) {
        $this->authorize('restore', new Car);

        if ($car = Car::withTrashed()->find($car->id)) {
            $car->restore();

            return redirect()->back()->with('status', 'Автомобиль восстановлен');
        }
    }

    public function reserve(CarReserveRequest $request, Car $car) {
        if ($car->canBeReserved($request->start, $request->end)) {
            if ($request->user()->canReserve($request->start, $request->end)) {
                $car->users()->attach($request->user()->id, ['start' => $request->start, 'end' => $request->end]);
                return $car->load('users');
            } else {
                return redirect()->back()->withErrors('Вы уже забронировали машину в это время');
            }
        } else {
            return redirect()->back()->withErrors('Машина занята в это время');
        }
    }
}
