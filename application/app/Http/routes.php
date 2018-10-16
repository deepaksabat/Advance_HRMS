<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Login*/
Route::get('/','UserController@login');
Route::post('user/get-login','UserController@getLogin');

/*Forgot Password*/
Route::get('forgot-password','UserController@forgotPassword');
Route::post('forgot-password-token','UserController@forgotPasswordToken');
Route::get('forgot-password-token-code/{token}','UserController@forgotPasswordTokenCode');


/*Logout*/
Route::get('user/logout','UserController@logout');

/*Dashboard*/
Route::get('dashboard','UserController@dashboard');

/*Profile Edit*/
Route::get('user/edit-profile','UserController@editProfile');
Route::post('user/post-user-personal-info','UserController@postUserPersonalInfo');
Route::post('user/update-user-avatar','UserController@updateUserAvatar');
Route::get('user/change-password','UserController@changePassword');
Route::post('user/update-user-password','UserController@updateUserPassword');

/*Designation Module*/
Route::get('designations','DesignationsController@designations');
Route::post('designations/add','DesignationsController@addDesignation');
Route::get('designations/delete/{id}','DesignationsController@deleteDesignation');
Route::post('designation/update','DesignationsController@updateDesignation');

/*Department Module*/
Route::get('departments','DepartmentController@departments');
Route::post('departments/add','DepartmentController@addDepartment');
Route::get('departments/delete/{id}','DepartmentController@deleteDepartment');
Route::post('departments/update','DepartmentController@updateDepartment');

/*Employee Module*/
Route::get('employees/all','EmployeeController@allEmployees');
Route::get('employees/add','EmployeeController@addEmployee');
Route::post('employees/add-employee-post','EmployeeController@addEmployeePost');
Route::get('employees/view/{id}','EmployeeController@viewEmployee');
Route::post('employees/post-employee-personal-info','EmployeeController@postEmployeePersonalInfo');
Route::post('employees/update-employee-avatar','EmployeeController@updateEmployeeAvatar');
Route::post('employee/get-designation','EmployeeController@getDesignation');
Route::post('employee/add-bank-account','EmployeeController@addBankInfo');
Route::get('employee/delete-bank-account/{id}','EmployeeController@deleteBankAccount');
Route::post('employee/add-document','EmployeeController@addDocument');
Route::get('employee/download-employee-document/{id}','EmployeeController@downloadEmployeeDocument');
Route::get('employee/delete-employee-doc/{id}','EmployeeController@deleteEmployeeDoc');
Route::get('employee/delete-employee/{id}','EmployeeController@deleteEmployee');

/*Job Application Module*/
Route::get('jobs','JobController@jobs');
Route::post('jobs/post-new-job','JobController@postNewJob');
Route::get('jobs/edit/{id}','JobController@editJob');
Route::post('jobs/job-edit-post','JobController@postEditJob');
Route::get('jobs/delete-job/{id}','JobController@deleteJob');
Route::get('jobs/view-applicant/{id}','JobController@viewApplicant');
Route::get('jobs/download-resume/{id}','JobController@downloadResume');
Route::get('jobs/delete-application/{id}','JobController@deleteApplication');
Route::post('jobs/set-applicant-status','JobController@setApplicantStatus');


/*Setting Module*/
Route::get('settings/general','SettingController@general');
Route::post('settings/post-general-setting','SettingController@postGeneralSetting');
Route::post('settings/post-office-time','SettingController@postOfficeTime');
Route::post('settings/post-expense-title','SettingController@postExpenseTitle');
Route::post('settings/post-leave-type','SettingController@postLeaveType');
Route::post('settings/post-award-name','SettingController@postAwardName');
Route::post('settings/post-job-file-extension','SettingController@postJobFileExtension');
Route::get('settings/localization','SettingController@localization');
Route::post('settings/localization-post','SettingController@localizationPost');
Route::get('settings/language-settings','SettingController@languageSettings');
Route::post('settings/language-settings/add','SettingController@addLanguage');
Route::get('settings/language-settings-translate/{lid}','SettingController@translateLanguage');
Route::post('settings/language-settings-translate-post','SettingController@translateLanguagePost');
Route::get('settings/language-settings-manage/{lid}','SettingController@languageSettingsManage');
Route::post('settings/language-settings-manage-post','SettingController@languageSettingManagePost');
Route::get('settings/language-settings/delete/{lid}','SettingController@deleteLanguage');


/*Language Change*/
Route::get('language/change/{id}','SettingController@languageChange');

/*Expense Settings*/
Route::get('settings/delete-expense/{id}','SettingController@deleteExpense');
Route::post('settings/update-expense-title','SettingController@updateExpenseTitle');

/*Leave Settings*/
Route::get('settings/delete-leave/{id}','SettingController@deleteLeave');
Route::post('settings/update-leave-type','SettingController@updateLeaveType');


/*Award Settings*/
Route::get('settings/delete-award/{id}','SettingController@deleteAward');
Route::post('settings/update-award-name','SettingController@updateAwardName');


/*Award Module*/
Route::get('award','AwardController@award');
Route::post('award/post-new-award','AwardController@postNewAward');
Route::get('award/delete-award/{id}','AwardController@deleteAward');
Route::get('award/edit/{id}','AwardController@editAward');
Route::post('award/award-edit-post','AwardController@postEditAward');


/*Holiday Module*/
Route::get('holiday','HolidayController@holiday');
Route::get('holiday/ajax-event-calendar','HolidayController@eventCalendar');
Route::get('holiday/add','HolidayController@addHoliday');
Route::post('holiday/post-add-holiday','HolidayController@postAddHoliday');
Route::get('holiday/view-holiday/{id}','HolidayController@viewHoliday');
Route::get('holiday/delete-holiday/{id}','HolidayController@deleteHoliday');
Route::post('holiday/post-edit-holiday','HolidayController@postEditHoliday');


/*Leave Module*/
Route::get('leave','LeaveController@leave');
Route::get('leave/edit/{id}','LeaveController@viewLeave');
Route::post('leave/post-job-status','LeaveController@postJobStatus');
Route::post('leave/post-new-leave','LeaveController@postNewLeave');
Route::get('leave/delete-leave-application/{id}','LeaveController@deleteLeaveApplication');

/*Notice Module*/
Route::get('notice-board','NoticeController@noticeBoard');
Route::post('notice-board/post-new-notice','NoticeController@postNewNotice');
Route::get('notice-board/delete-notice/{id}','NoticeController@deleteNotice');
Route::get('notice-board/edit/{id}','NoticeController@editNotice');
Route::post('notice-board/edit-notice-post','NoticeController@postEditNotice');

/*Expense Module*/
Route::get('expense','ExpenseController@expense');
Route::post('expense/post-new-expense','ExpenseController@postExpense');
Route::get('expense/download-bill-copy/{id}','ExpenseController@downloadBillCopy');
Route::get('expense/delete-expense/{id}','ExpenseController@deleteExpense');
Route::get('expense/edit/{id}','ExpenseController@editExpense');
Route::post('expense/expense-edit-post','ExpenseController@postEditExpense');


/*Task Module*/
Route::get('task','TaskController@task');
Route::post('task/post-new-task','TaskController@postNewTask');
Route::get('task/edit/{id}','TaskController@editTask');
Route::post('task/task-edit-post','TaskController@postEditTask');
Route::get('task/view/{id}','TaskController@viewTask');
Route::post('task/task-basic-info-post','TaskController@postBasicTaskInfo');
Route::post('task/post-task-comments','TaskController@postTaskComments');
Route::post('task/post-task-files','TaskController@postTaskFiles');
Route::get('task/download-file/{id}','TaskController@downloadTaskFIle');
Route::get('task/delete-task-file/{id}','TaskController@deleteTaskFIle');
Route::get('task/delete-task/{id}','TaskController@deleteTask');

/*Attendance Module */
Route::get('attendance/report','AttendanceController@report');
Route::get('attendance/update','AttendanceController@update');
Route::post('attendance/post-update-attendance','AttendanceController@postUpdateAttendance');
Route::post('attendance/get-designation','AttendanceController@getDesignation');
Route::post('attendance/post-custom-search','AttendanceController@postCustomSearch');
Route::get('attendance/edit/{id}','AttendanceController@editAttendance');
Route::post('attendance/post-edit-attendance','AttendanceController@postEditAttendance');
Route::get('attendance/delete-attendance/{id}','AttendanceController@deleteAttendance');
Route::post('attendance/set-overtime','AttendanceController@postSetOvertime');


/*Support Ticket Module*/
Route::get('support-tickets/all','SupportTicketController@all');
Route::get('support-tickets/create-new','SupportTicketController@createNew');
Route::get('support-tickets/view-ticket/{id}','SupportTicketController@viewTicket');
Route::get('support-tickets/department','SupportTicketController@department');
Route::get('support-tickets/view-department/{id}','SupportTicketController@viewDepartment');
Route::get('support-tickets/ticket-department/{id}','SupportTicketController@ticketDepartment');
Route::get('support-tickets/ticket-status/{id}','SupportTicketController@ticketStatus');
Route::post('support-tickets/post-department','SupportTicketController@postDepartment');
Route::post('support-tickets/update-department','SupportTicketController@updateDepartment');
Route::post('support-tickets/post-ticket','SupportTicketController@postTicket');
Route::post('support-tickets/ticket-update-department','SupportTicketController@updateTicketDepartment');
Route::post('support-tickets/ticket-update-status','SupportTicketController@updateTicketStatus');
Route::post('support-tickets/replay-ticket','SupportTicketController@replayTicket');
Route::get('support-tickets/delete-ticket/{id}','SupportTicketController@deleteTicket');
Route::get('support-tickets/delete-department/{id}','SupportTicketController@deleteDepartment');
Route::post('support-ticket/basic-info-post','SupportTicketController@postBasicInfo');
Route::post('support-ticket/post-ticket-files','SupportTicketController@postTicketFiles');
Route::get('support-ticket/download-file/{id}','SupportTicketController@downloadTicketFile');
Route::get('support-ticket/delete-ticket-file/{id}','SupportTicketController@deleteTicketFile');


/*Payroll Module*/
Route::get('payroll/employee-salary-list','PayrollController@employeeSalaryList');
Route::get('payroll/employee-salary-edit/{id}','PayrollController@editEmployeeSalary');
Route::post('payroll/edit-employee-salary-post','PayrollController@postEditEmployeeSalary');
Route::get('payroll/make-payment','PayrollController@makePayment');
Route::post('payroll/make-payment/post-custom-search','PayrollController@postCustomSearch');
Route::post('payroll/get-designation','PayrollController@getDesignation');
Route::get('payroll/generate','PayrollController@generatePayslip');
Route::get('payroll/pay-payment/{emp_id}/{date}','PayrollController@payPayment');
Route::post('payroll/pay-payment-post','PayrollController@payPaymentPost');
Route::post('payroll/payslip/post-custom-search','PayrollController@postPayslipCustomSearch');
Route::get('payroll/view-details/{id}','PayrollController@viewDetails');
Route::get('payroll/print-payslip/{id}','PayrollController@printPayslip');
Route::get('payroll/employee-salary-increment','PayrollController@employeeSalaryIncrement');
Route::get('payroll/employee-salary-increment-edit/{id}','PayrollController@editEmployeeSalaryIncrement');
Route::post('payroll/edit-employee-salary-increment-post','PayrollController@postEditEmployeeSalaryIncrement');


/*Provident Fund*/
Route::get('provident-fund/all','PayrollController@providentFund');
Route::post('provident-fund/post-new-provident-fund','PayrollController@postProvidentFund');
Route::get('provident-fund/view-details/{id}','PayrollController@viewProvidentFund');
Route::post('provident-fund/edit-post','PayrollController@postEditProvidentFund');
Route::get('provident-fund/delete/{id}','PayrollController@deleteProvidentFund');
Route::post('provident-fund/make-payment','PayrollController@makePaymentProvidentFund');
Route::get('provident-fund/view-payslip/{id}','PayrollController@payslipProvidentFund');
Route::get('provident-fund/print-payslip/{id}','PayrollController@printPayslipProvidentFund');

/*Loan Module*/
Route::get('loan/all','PayrollController@loan');
Route::post('loan/post-new-loan','PayrollController@postNewLoan');
Route::get('loan/view-details/{id}','PayrollController@viewDetailsLoan');
Route::post('loan/edit-post','PayrollController@postEditLoan');
Route::get('loan/delete/{id}','PayrollController@deleteLoan');



/*Email Template Module*/
Route::get('settings/email-templates','SettingController@emailTemplates');
Route::get('settings/email-template-manage/{id}','SettingController@manageTemplate');
Route::post('settings/email-templates-update','SettingController@updateTemplate');

/*Tax Rules*/
Route::get('settings/tax-rules','SettingController@taxRules');
Route::post('tax-rules/post-new-tax','SettingController@postNewTax');
Route::get('tax-rules/set-rules/{tid}','SettingController@setRules');
Route::post('tax-rules/post-set-rules','SettingController@postSetRules');
Route::get('tax-rules/delete-tax-rule/{tid}','SettingController@deleteTaxRule');
Route::post('tax-rules/post-update-tax-rules','SettingController@postUpdateTaxRules');

/*SMS Gateways*/
Route::get('settings/sms-gateways','SettingController@smsGateways');
Route::get('settings/sms-gateways-manage/{id}','SettingController@smsGatewayManage');
Route::post('settings/sms-gateway-update','SettingController@smsGatewayUpdate');



/*Reports Module*/

Route::get('reports/payroll','ReportsController@payrollSummery');
Route::post('reports/get-salary-statement','ReportsController@getSalaryStatement');
Route::get('reports/print-salary-statement/{id}/{date_from}/{date_to}','ReportsController@printSalaryStatement');
Route::get('reports/employee-summery/{id}','ReportsController@employeeSummery');
Route::get('reports/job-applicants','ReportsController@jobApplicants');
Route::post('reports/send-email-to-applicants','ReportsController@sendEmailApplicant');
Route::post('reports/send-sms-to-applicants','ReportsController@sendSMSApplicant');
Route::post('reports/send-sms-salary-statement','ReportsController@sendSMSSalaryStatement');
Route::post('reports/send-email-salary-statement','ReportsController@sendEmailSalaryStatement');



/*Employee Portal*/

/*Employee Dashboard*/
Route::get('employee/dashboard','UserController@employeeDashboard');

/*Logout*/
Route::get('employee/logout','UserController@logout');

/*Profile Edit*/
Route::get('employee/edit-profile','UserController@editEditProfile');
Route::post('employee/post-employee-personal-info','UserController@postEmployeePersonalInfo');
Route::post('employee/update-employee-avatar','UserController@updateEmployeeAvatar');
Route::get('employee/change-password','UserController@changeEmployeePassword');
Route::post('employee/update-employee-password','UserController@updateEmployeePassword');

/*Employee Holiday*/
Route::get('employee/holiday','EmployeePortalController@holiday');
Route::get('employee/holiday/ajax-event-calendar','EmployeePortalController@eventCalendar');

/*Employee Award*/
Route::get('employee/award','EmployeePortalController@award');

/*Employee Leave*/
Route::get('employee/leave','EmployeePortalController@leave');
Route::post('employee/leave/post-new-leave','EmployeePortalController@postNewLeave');

/*Employee Notice Board*/
Route::get('employee/notice-board','EmployeePortalController@noticeBoard');

/*Employee Expense*/
Route::get('employee/expense','EmployeePortalController@expense');
Route::post('employee/expense/post-new-expense','EmployeePortalController@postExpense');

/*Employee Support Ticket*/
Route::get('employee/support-tickets/all','EmployeePortalController@allSupportTickets');
Route::get('employee/support-tickets/create-new','EmployeePortalController@createNewTicket');
Route::post('employee/support-tickets/post-ticket','EmployeePortalController@postTicket');
Route::get('employee/support-tickets/view-ticket/{id}','EmployeePortalController@viewTicket');
Route::post('employee/support-tickets/replay-ticket','EmployeePortalController@replayTicket');
Route::post('employee/support-ticket/post-ticket-files','EmployeePortalController@postTicketFiles');
Route::get('employee/support-ticket/download-file/{id}','EmployeePortalController@downloadTicketFile');

/*Employee Payroll*/
Route::get('employee/payslip','EmployeePortalController@paySlip');
Route::get('employee/payslip/view/{id}','EmployeePortalController@viewPaySlip');
Route::get('employee/payslip/print-payslip/{id}','EmployeePortalController@printPaySlip');

/*Employee Task*/
Route::get('employee/task','EmployeePortalController@task');
Route::get('employee/task/view/{id}','EmployeePortalController@viewTask');
Route::post('employee/task/post-task-comments','EmployeePortalController@postTaskComments');
Route::post('employee/task/post-task-files','EmployeePortalController@postTaskFiles');
Route::get('employee/task/download-file/{id}','EmployeePortalController@downloadTaskFIle');


/*Apply Job*/
Route::get('apply-job','UserController@applyJob');
Route::get('apply-job/details/{id}','UserController@applyJobDetails');
Route::post('apply-job/post-applicant-resume','UserController@postApplicantResume');

/*Clock In, Out*/
Route::post('employee/attendance/set_clocking','EmployeePortalController@setClocking');

/*Loan*/
Route::get('employee/loan/all','EmployeePortalController@allLoan');
Route::post('employee/loan/post-new-loan','EmployeePortalController@postNewLoan');
Route::get('employee/loan/view-details/{id}','EmployeePortalController@viewLoanDetails');
Route::post('employee/loan/edit-post','EmployeePortalController@postEditLoan');



/*Version 1.5*/

/*For Admin Portal*/

Route::get('payroll/download-pdf/{id}','PayrollController@downloadPdf');
Route::get('reports/pdf-salary-statement/{id}/{date_from}/{date_to}','ReportsController@pdfSalaryStatement');

/*Training*/

Route::get('training/trainers','TrainingController@trainers');
Route::post('training/post-new-trainer','TrainingController@postNewTrainer');
Route::get('training/delete-trainer/{id}','TrainingController@deleteTrainer');
Route::get('training/view-trainers-info/{id}','TrainingController@viewTrainersInfo');
Route::post('training/post-trainer-update-info','TrainingController@postTrainerUpdateInfo');
Route::get('training/employee-training','TrainingController@employeeTraining');
Route::post('training/post-new-training','TrainingController@postNewTraining');
Route::get('training/delete-employee-training/{id}','TrainingController@deleteEmployeeTraining');
Route::get('training/view-employee-training/{id}','TrainingController@viewEmployeeTraining');
Route::post('training/post-employee-training-info','TrainingController@postEmployeeTrainingInfo');
Route::get('training/training-needs-assessment','TrainingController@trainingNeedsAssessment');
Route::post('training/post-new-training-needs-assessment','TrainingController@postNewTrainingNeedsAssessment');
Route::get('training/delete-training-needs-assessment/{id}','TrainingController@deleteTrainingNeedsAssessment');
Route::get('training/view-training-needs-assessment/{id}','TrainingController@viewTrainingNeedsAssessment');
Route::get('training/view-training-needs-assessment/{id}','TrainingController@viewTrainingNeedsAssessment');
Route::post('training/post-training-needs-assessment-update','TrainingController@postTrainingNeedsAssessmentUpdate');
Route::get('training/training-events','TrainingController@trainingEvents');
Route::post('training/post-new-training-event','TrainingController@postNewTrainingEvent');
Route::get('training/delete-training-event/{id}','TrainingController@deleteTrainingEvent');
Route::get('training/view-training-events/{id}','TrainingController@viewTrainingEvent');
Route::post('training/post-training-events-update','TrainingController@postTrainingEventUpdate');
Route::get('training/evaluations','TrainingController@TrainingEvaluations');
Route::post('training/post-training-evaluations','TrainingController@postTrainingEvaluations');
Route::post('training/update-training-evaluations','TrainingController@updateTrainingEvaluations');
Route::get('training/delete-training-evaluations/{id}','TrainingController@deleteTrainingEvaluations');

/*For Employee Role management*/

Route::get('employees/roles','EmployeeController@employeeRoles');
Route::post('employees/add-roles','EmployeeController@addEmployeeRoles');
Route::post('employees/update-role','EmployeeController@updateEmployeeRoles');
Route::get('employees/set-roles/{id}','EmployeeController@setEmployeeRoles');
Route::post('employees/update-employee-set-roles','EmployeeController@updateEmployeeSetRoles');
Route::get('employees/delete-roles/{id}','EmployeeController@deleteEmployeeRoles');

/*Permission Check*/
Route::get('permission-error','UserController@permissionError');


Route::get('attendance/get-all-pdf-report','AttendanceController@getAllPdfReport');
Route::get('attendance/get-pdf-report/{date}/{emp_id?}/{dep_id?}/{des_id?}','AttendanceController@getPdfReport');


/*
|--------------------------------------------------------------------------
| Disable Menu For specific Employee
|--------------------------------------------------------------------------
|
| You can show hide Admin Menu/Employee Menu for specific Employee
|
*/
Route::get('settings/disable-menus','SettingController@disableMenus');
Route::get('settings/disable-menus-manage/{id}','SettingController@disableMenusManage');
Route::post('settings/disable-menus-post','SettingController@disableMenusManagePost');

/*Employee Portal*/
Route::get('employee/attendance','EmployeePortalController@attendance');
Route::get('employee/training','EmployeePortalController@training');
Route::get('employee/training/view/{id}','EmployeePortalController@viewTraining');

/*Update Application*/
Route::get('update','UserController@updateApplication');