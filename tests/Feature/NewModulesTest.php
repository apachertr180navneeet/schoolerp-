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

    public function test_homework_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('homework.view'));
        $response->assertStatus(200);
        $response->assertSee('Homework', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('homework.add'));
        $responseAdd->assertStatus(200);
        $responseAdd->assertSee('Assign New Homework', false);
    }

    public function test_notice_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('notice.view'));
        $response->assertStatus(200);
        $response->assertSee('Notice Board', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('notice.add'));
        $responseAdd->assertStatus(200);
        $responseAdd->assertSee('Post Circular Notice', false);
    }

    public function test_front_office_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('visitor.view'));
        $response->assertStatus(200);
        $response->assertSee('Front Office', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('visitor.add'));
        $responseAdd->assertStatus(200);
        $responseAdd->assertSee('New Visitor Entry Pass', false);
    }

    public function test_inventory_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('inventory.item.view'));
        $response->assertStatus(200);
        $response->assertSee('Store Inventory', false);

        $responseAdd = $this->actingAs($this->adminUser)->get(route('inventory.item.add'));
        $responseAdd->assertStatus(200);

        $responseIssue = $this->actingAs($this->adminUser)->get(route('inventory.issue.view'));
        $responseIssue->assertStatus(200);
        $responseIssue->assertSee('Inventory Issue', false);
    }

    public function test_exam_schedule_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('exam.schedule.view'));
        $response->assertStatus(200);
        $response->assertSee('Examination Datesheet', false);

        $responseAdmit = $this->actingAs($this->adminUser)->get(route('exam.admitcard.view'));
        $responseAdmit->assertStatus(200);
        $responseAdmit->assertSee('Generate Student Admit Card', false);
    }

    public function test_hostel_screens_load(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('hostel.room.view'));
        $response->assertStatus(200);
        $response->assertSee('Hostel', false);

        $responseAllot = $this->actingAs($this->adminUser)->get(route('hostel.allotment.view'));
        $responseAllot->assertStatus(200);
        $responseAllot->assertSee('Hostel Bed Allotments', false);
    }

    public function test_student_medical_and_leave_screens_load(): void
    {
        $responseMed = $this->actingAs($this->adminUser)->get(route('student.medical.view'));
        $responseMed->assertStatus(200);
        $responseMed->assertSee('Health & Medical Records', false);

        $responseLeave = $this->actingAs($this->adminUser)->get(route('student.leave.view'));
        $responseLeave->assertStatus(200);
        $responseLeave->assertSee('Student Leave Applications', false);
    }

    public function test_system_activity_and_portals_load(): void
    {
        $responseLog = $this->actingAs($this->adminUser)->get(route('system.activity.log'));
        $responseLog->assertStatus(200);
        $responseLog->assertSee('System Audit & Activity Logs', false);

        $responseParent = $this->actingAs($this->adminUser)->get(route('portal.parent.dashboard'));
        $responseParent->assertStatus(200);
        $responseParent->assertSee('Parent Portal', false);

        $responseStudent = $this->actingAs($this->adminUser)->get(route('portal.student.dashboard'));
        $responseStudent->assertStatus(200);
        $responseStudent->assertSee('Student Portal', false);

        $responseTeacher = $this->actingAs($this->adminUser)->get(route('portal.teacher.dashboard'));
        $responseTeacher->assertStatus(200);
        $responseTeacher->assertSee('Teacher Workspace', false);
    }
}
