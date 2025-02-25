<?php

namespace Database\Seeders;

use App\Models\Activities;
use App\Models\Assessment;
use App\Models\Attachment;
use App\Models\Attachment_Santri;
use App\Models\Attendance;
use App\Models\Departement;
use App\Models\Program_Stage;
use App\Models\Financial_Record;
use App\Models\Kelas;
use App\Models\News;
use App\Models\Permission;
use App\Models\Rapot_Santri;
use App\Models\Santri_Family;
use App\Models\Subject;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $KelasData = Kelas::factory(50)->create();
        $Program_StageData = Program_Stage::factory(50)->create();
        $DepartementData = Departement::factory(50)->create();
        $NewsData = News::factory(50)->create();
        $Attachment_Santri = Attachment_Santri::factory(50)->create();
        $UserData = User::factory(50)->create();
        $SubjectData = Subject::factory(50)->create();
        $AssessmentData = Assessment::factory(50)->create();
        $PermissionData = Permission::factory(50)->create();
        $ActivitiesData = Activities::factory(50)->create();
        $AttendanceData = Attendance::factory(50)->create();
        $Rapot_SantriData = Rapot_Santri::factory(50)->create();
        $Financial_RecordData = Financial_Record::factory(50)->create();
        $AttachmentData = Attachment::factory(50)->create();
        $SantriFamiliy = Santri_Family::factory(50)->create();

        foreach($UserData as $user)
        {
            $user->update([
                'class_id'           => Kelas::all()->random()->id,
                'departement_id'      => Departement::all()->random()->id,
                'program_stage_id' => Program_stage::all()->random()->id,
            ]);
        }
        foreach($SubjectData as $data)
        {
            $data->update([
                'class_id'           => Kelas::all()->random()->id,
                // 'deputy_id'      => Departement::all()->random()->id,
                // 'program_stage_id' => program_stage::all()->random()->id,
            ]);
        }
        foreach($NewsData as $news)
        {
            $news->update([
                'user_id'          => User::all()->random()->id,
            ]);
        }
        foreach($Rapot_SantriData as $rapot)
        {
            $rapot->update([
                'user_id'          => User::all()->random()->id,
            ]);
        }
        foreach($AttendanceData as $Attendance)
        {
            $Attendance->update([
                'user_id'          => User::all()->random()->id,
                'activity_id'          => Activities::all()->random()->id,
            ]);
        }
        foreach($SubjectData as $subjek)
        {
            $subjek->update([
                'class_id'          => Kelas::all()->random()->id,
            ]);
        }
        foreach($DepartementData as $departements)
        {
            $departements->update([
                'leader_id'          => User::all()->random()->id,
                'deputy_id'          => User::all()->random()->id,
            ]);
        }
        foreach($SantriFamiliy as $santri)
        {
            $santri->update([
                'user_id'          => User::all()->random()->id,
            ]);
        }
        foreach($PermissionData as $Permission)
        {
            $Permission->update([
                'user_id'          => User::all()->random()->id,
            ]);
        }
        foreach($AssessmentData as $assessment)
        {
            $assessment->update([
                'user_id'          => User::all()->random()->id,
                'subject_id'          => Subject::all()->random()->id,
            ]);
        }

        // // Kelas::factory(10)->create();
        // program_stage::factory(10)->create();
        // Departement::factory(10)->create();
        // Subject::factory(10)->create();
        // Assessment::factory(10)->create();
        // Permission::factory(10)->create();
        // Activities::factory(10)->create();
        // Attendance::factory(10)->create();
        // News::factory(10)->create();
        // Rapot_Santri::factory(10)->create();
        // Financial_Record::factory(10)->create();
        // // Attachment::factory(10)->create();
    }
}
