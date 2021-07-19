<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    //Use RefreshDatabase to test with fresh DB
    // use RefreshDatabase;

    public function test_the_employees_index_page_is_rendered_correctly()
    {
        // add this for more detailed info of an error 
        $this->withoutExceptionHandling();
        //note:don't use if yout test is based on validation
        
        // we want to create authanticable user
        $user  = User::factory()->create();
        
        // then authenticate this user
        $this->actingAs($user);
        
        // we want to hist dashboard/employees page
        $response = $this->get('dashboard/employees');

        $response->assertStatus(200);
    }

    public function test_users_can_create_employees(){
        
        //It disables middleware for testing
        $this->withoutMiddleware();
        
        // we want to create authanticable user
        $user  = User::factory()->create();

        // then authenticate this user
        $this->actingAs($user);

        // fake employee data
        $employee = Employee::factory()->create(['company_id'=>1]);

        // hit employees route with post request
        $response = $this->post('dashboard/employees',[$employee]);
        // assert we were redirecting to the dashboard/companies page
        $response->assertStatus(200); 
    }
}