<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class DepartmentDataService
{
    public function isInternalEmail($userEmail)
    {
        $emails = Cache::remember(
            'dept_service_user_emails',
            config('constants.department_data.cache_duration'),
            function () {

                // Students 
                $students = $this->getData('/people/v1/students/all/');
                $student_emails = collect($students)->map(function ($user) {
                    $faculty_name = $user['emails']['faculty']['name'];
                    $faculty_domain = $user['emails']['faculty']['domain'];

                    $personal_name = $user['emails']['faculty']['name'];
                    $personal_domain = $user['emails']['faculty']['domain'];

                    if ($faculty_domain == 'eng.pdn.ac.lk' && $faculty_name != '' && $faculty_domain != '') {
                        // Faculty Email
                        return "$faculty_name@$faculty_domain";
                    } else if ($personal_domain == 'eng.pdn.ac.lk') {
                        // Personal Email
                        return "$personal_name@$personal_domain";
                    }
                    return null;
                });

                // Staff
                $staff = $this->getData('/people/v1/staff/all/');
                $staff_emails = collect($staff)->map(function ($user) {
                    return $user['email'];
                });

                return $student_emails->union($staff_emails)->filter()->values()->toArray();
            }
        );
        return in_array($userEmail, $emails);
    }

    private function getData($endpoint)
    {
        $url = config('constants.department_data.base_url') . $endpoint;
        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        } else {
            $statusCode = $response->status();
            $errorMessage = $response->body();

            // TODO: Handle error 
            return [];
        }
    }
}
