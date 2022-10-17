<?php

namespace Tests\Unit;

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class CarReservationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $car;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->car = Car::factory()->create();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCanReserveFreeUser()
    {
        $this->assertTrue($this->user->canReserve(Carbon::create('2022', '10', '17', '17', '0'), Carbon::create('2022', '10', '17', '18', '0')));
    }

    public function testCannotReserveNotFreeUser() {
        $this->user->cars()->attach(1, [
            'start' => Carbon::create('2022', '10', '17', '17', '0'),
            'end' => Carbon::create('2022', '10', '17', '18', '0')
        ]);

        $this->assertFalse($this->user->canReserve(Carbon::create('2022', '10', '17', '17', '30'), Carbon::create('2022', '10', '17', '18', '0')));
    }

    public function testCanReserveFreeCar() {
        $this->assertTrue($this->car->canBeReserved(Carbon::create('2022', '10', '17', '17', '30'), Carbon::create('2022', '10', '17', '18', '0')));
    }

    public function testCannotReserveNotFreeCar() {
        $this->car->users()->attach(1, [
            'start' => Carbon::create('2022', '10', '17', '17', '0'),
            'end' => Carbon::create('2022', '10', '17', '18', '0')
        ]);

        $this->assertFalse($this->car->canBeReserved(Carbon::create('2022', '10', '17', '17', '30'), Carbon::create('2022', '10', '17', '18', '0')));
    }



    protected function tearDown(): void
    {
        // Do something
        parent::tearDown();
    }


}
