<?php
/**
 * User: shamim
 * Date: 10/17/16
 * Time: 11:19 AM
 */

namespace App\Classes;

use App\EmployeeRolesPermission;


Class permission {

public static $perms = array(
1 => 'dashboard',
2 => 'departments',
3 => 'designations',
4 => 'employees',
5 => 'add-employee',
6 => 'update-employee',
7 => 'delete-employee',
8 => 'employee-roles',
9 => 'add-employee-role',
10 => 'delete-employee-role',
11 => 'job-application',
12 => 'add-new-job',
13 => 'job-applicants',
14 => 'attendance-report',
15 => 'update-attendance',
16 => 'leave-application',
17 => 'holiday',
18 => 'add-new-holiday',
19 => 'award-list',
20 => 'add-new-award',
21 => 'notice-board',
22 => 'add-new-notice',
23 => 'expense',
24 => 'add-new-expense',
25 => 'employee-salary-list',
26 => 'employee-salary-increment',
27 => 'make-payment',
28 => 'generate-payslip',
29 => 'provident-fund',
30 => 'loan',
31 => 'employee-training',
32 => 'add-employee-training',
33 => 'training-needs-assessment',
34 => 'add-training-needs-assessment',
35 => 'training-events',
36 => 'add-training-events',
37 => 'trainers',
38 => 'add-new-trainer',
39 => 'training-evaluations',
40 => 'task',
41 => 'add-new-task',
42 => 'support-tickets',
43 => 'create-new-ticket',
44 => 'manage-support-ticket',
45 => 'support-department',
46 => 'add-support-department',
47 => 'employee-payroll-summery',
48 => 'system-settings',
49 => 'localization',
50 => 'email-templates',
51 => 'tax-rules',
52 => 'add-tax-rule',
53 => 'language',
54 => 'add-language',
55 => 'sms-gateways'
);


    public static function permitted ($page) {

        $perms=self::$perms;
        $permid = array_search($page, $perms);

        $role = \Auth::user()->role_id;


        $permcheck = EmployeeRolesPermission::where('role_id', $role)->where('perm_id', $permid)->first();

        if ($permcheck==NULL){
            return 'access denied';
        }else{
            if ($permcheck->perm_id<0){
                return 'access denied';
            }else{
                return 'access granted';
            }
        }

    }

}