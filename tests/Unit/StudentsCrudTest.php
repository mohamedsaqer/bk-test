<?php

namespace Tests\Unit;

use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class StudentsCrudTest extends TestCase
{
    use WithFaker;

    public function createUserToken()
    {
        $user = User::find(1);
        if (Auth::attempt(['email' => $user->email, 'password' => 'password'])) {
            $authUser = Auth::user();
            $token = $authUser->createToken('MyAuthApp')->plainTextToken;

            return $token;
        }
    }

    /**
     * testing route: students.list
     * method: get
     *
     * @test
     */
    public function test_get_students()
    {
        // get token
        $token = self::createUserToken();

        // Call API ,assert success status & assert valid response structure
        $this->withHeader('Authorization', $token)
            ->get(route('students.list'))
            ->assertStatus(200);
    }

    /**
     * testing route: students.show
     * method: get
     *
     * @test
     */
    public function test_get_student()
    {
        // get token
        $token = self::createUserToken();
        // create student
        $student = Student::factory()->createOne();

        // Call API ,assert success status & assert valid response structure
        $this->withHeader('Authorization', $token)
            ->delete(route('students.show', ['student' => $student]))
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['name', 'id', 'school_id', 'school_name', 'order', 'created', 'updated']]);
    }

    /**
     * testing route: students.store
     * method: post
     *
     * @test
     */
    public function test_store_student()
    {
        // get token
        $token = self::createUserToken();

        // Call API ,assert success status & assert valid response structure
        $this->withHeader('Authorization', $token)
            ->post(route('students.store'), $this->requestPayload())
            ->assertStatus(201)
            ->assertJsonStructure(['data' => ['name', 'id', 'school_id', 'school_name', 'order', 'created', 'updated']]);
    }

    /**
     * testing route: students.update
     * method: put
     *
     * @test
     */
    public function test_update_student()
    {
        // get token
        $token = self::createUserToken();
        // create student
        $student = Student::factory()->createOne();

        // Call API ,assert success status & assert valid response structure
        $this->withHeader('Authorization', $token)
            ->put(route('students.update', ['student' => $student]), $this->requestPayload())
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['name', 'id', 'school_id', 'school_name', 'order', 'created', 'updated']]);
    }

    /**
     * testing route: students.destroy
     * method: delete
     *
     * @test
     */
    public function test_delete_student()
    {
        // get token
        $token = self::createUserToken();
        // create student
        $student = Student::factory()->createOne();

        // Call API ,assert success status & assert valid response structure
        $this->withHeader('Authorization', $token)
            ->delete(route('students.destroy', ['student' => $student]))
            ->assertStatus(200)
            ->assertJsonStructure(['data' => ['name', 'id', 'school_id', 'school_name', 'order', 'created', 'updated']]);
    }

    private function requestPayload()
    {
        $school = School::factory()->createOne();

        return [
            'name' => $this->faker->firstName(),
            'school_id' => $school->id,
            'order' => 1,
        ];
    }
}
