<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class NewModulesTest extends TestCase
{
    protected $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@mail.com')->first();
    }

    public function test_school_profile_screen_loads(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('school.profile.view'));
        $response->assertStatus(200);
        $response->assertSee('School Profile', false);
    }

    public function test_student_section_screen_loads(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('student.section.view'));
        $response->assertStatus(200);
        $response->assertSee('Student Section Master', false);
    }

    public function test_student_attendance_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('student.attendance.view'));
        $response->assertStatus(200);
        $response->assertSee('Student Daily Attendance Logs', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('student.attendance.add'));
        $responseAdd->assertStatus(200);
    }

    public function test_admission_enquiry_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admission.enquiry.view'));
        $response->assertStatus(200);
        $response->assertSee('Admission Enquiries', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('admission.enquiry.add'));
        $responseAdd->assertStatus(200);
        $responseAdd->assertSee('Record New Admission Enquiry', false);
    }

    public function test_academic_timetable_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('academic.timetable.view'));
        $response->assertStatus(200);
        $response->assertSee('Class Timetable', false);
    }

    public function test_student_certificate_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('certificate.tc.view'));
        $response->assertStatus(200);
        $response->assertSee('Transfer Certificate', false);

        $responseBonafide = $this->actingAs($this->adminUser)->get(route('certificate.bonafide.view'));
        $responseBonafide->assertStatus(200);
        $responseBonafide->assertSee('Bonafide Student Certificate', false);
    }

    public function test_library_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('library.book.view'));
        $response->assertStatus(200);
        $response->assertSee('Library Book Catalog', false);

        $responseIssue = $this->actingAs($this->adminUser)->get(route('library.issue.view'));
        $responseIssue->assertStatus(200);
        $responseIssue->assertSee('Library Circulation', false);
    }

    public function test_transport_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('transport.vehicle.view'));
        $response->assertStatus(200);
        $response->assertSee('School Transport Fleet', false);

        $responseRoute = $this->actingAs($this->adminUser)->get(route('transport.route.view'));
        $responseRoute->assertStatus(200);
        $responseRoute->assertSee('Transport Routes', false);

        $responseStudent = $this->actingAs($this->adminUser)->get(route('transport.student.view'));
        $responseStudent->assertStatus(200);
        $responseStudent->assertSee('Student Transport Allocations', false);
    }
}
