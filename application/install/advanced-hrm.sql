-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2017 at 08:21 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_04_23_104114_Create_Employee_Table', 1),
('2016_05_03_054932_Create_AppConfig_Table', 1),
('2016_05_08_031144_Create_Designation_Table', 1),
('2016_05_08_031315_Create_Department_Table', 1),
('2016_05_10_072042_Create_Jobs_Table', 1),
('2016_05_11_052103_Create_Job_Applicatans_Table', 1),
('2016_05_15_030642_Create_Expense_Title_Table', 1),
('2016_05_15_052304_Create_Leave_Type_Table', 1),
('2016_05_15_060320_Create_Award_Table', 1),
('2016_05_17_033109_Create_Award_List_Table', 1),
('2016_05_18_053547_Create_Leave_Table', 1),
('2016_05_18_095724_Create_Notice_Table', 1),
('2016_05_19_083955_Create_Expense_Table', 1),
('2016_05_25_054712_Create_Task_Table', 1),
('2016_05_25_081016_Create_Task_Employee_Table', 1),
('2016_05_25_081155_Create_Task_Comments_Table', 1),
('2016_05_25_081212_Create_Task_Files_Table', 1),
('2016_05_29_082935_Create_Attendance_Table', 1),
('2016_05_30_102055_Create_Ticket_Table', 1),
('2016_05_30_102221_Create_Ticket_Replies_Table', 1),
('2016_05_30_102324_Create_Support_Department_Table', 1),
('2016_05_31_040818_Create_Ticket_Files_Table', 1),
('2016_05_31_054434_Create_Holiday_Table', 1),
('2016_06_06_054455_Create_Payroll_Table', 1),
('2016_06_07_091352_Create_Employee_Bank_Accounts_Table', 1),
('2016_06_08_054356_Create_Employee_Files_Table', 1),
('2016_06_11_044412_Create_Email_Template_Table', 1),
('2016_06_27_070853_Create_Language_Table', 1),
('2016_06_27_071118_Create_Language_Data_Table', 1),
('2016_08_14_060701_Create_Tax_Rules_Tables', 1),
('2016_08_14_081647_Create_Tax_Rules_Details_Table', 1),
('2016_08_16_110543_Create_Provident_Fund_Table', 1),
('2016_08_18_040810_Create_Loan_Table', 1),
('2016_08_20_033239_Create_sms_gateways_Table', 1),
('2016_10_03_093308_Create_Employee_Training_Table', 1),
('2016_10_03_103333_Create_Training_Members_Table', 1),
('2016_10_03_104829_Create_Trainers_Table', 1),
('2016_10_06_064420_Create_Training_Needs_Assessment', 1),
('2016_10_06_065039_Create_Training_Needs_Assessment_Memebers_Table', 1),
('2016_10_08_084446_Create_Training_Events_Table', 1),
('2016_10_08_085729_Create_Training_Events_Employee_Table', 1),
('2016_10_08_085752_Create_Training_Events_Trainers_Table', 1),
('2016_10_11_090733_Create_Training_Evaluations_Table', 1),
('2016_10_13_060328_Create_Employee_Roles_Table', 1),
('2016_10_16_080215_Create_Employee_Roles_Permission', 1),
('2017_01_01_035204_Create_Disable_Menu', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sys_appconfig`
--

CREATE TABLE `sys_appconfig` (
  `id` int(10) UNSIGNED NOT NULL,
  `setting` text COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_appconfig`
--

INSERT INTO `sys_appconfig` (`id`, `setting`, `value`, `created_at`, `updated_at`) VALUES
(1, 'AppName', 'Advanced HRM', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(2, 'AppUrl', 'localhost:8000', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(3, 'PurchaseKey', '', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(4, 'Email', 'support@coderpixel.com', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(5, 'Address', 'House#69 (Parents House), <br>Gulshan-1<br>Gulshan<br>Dhaka<br>1212<br>Bangladesh', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(6, 'SoftwareVersion', '1.6.0', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(7, 'AppTitle', 'Advanced HRM', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(8, 'FooterTxt', 'Copyright &copy; Coder Pixel 2017', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(9, 'AppLogo', 'assets/img/logo.png', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(10, 'AppFav', 'assets/img/favicon.ico', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(11, 'Country', 'United States of America', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(12, 'Timezone', 'Asia/Dhaka', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(13, 'Currency', 'USD', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(14, 'CurrencyCode', '$', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(15, 'Gateway', 'default', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(16, 'SMTPHostName', 'smtp.gmail.com', '2017-06-14 00:16:46', '2017-06-14 00:16:46'),
(17, 'SMTPUserName', 'user@example.com', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(18, 'SMTPPassword', 'testpassword', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(19, 'SMTPPort', '587', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(20, 'SMTPSecure', 'tls', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(21, 'AppStage', 'Live', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(22, 'OfficeInTime', '09:25 AM', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(23, 'OfficeOutTime', '05:25 PM', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(24, 'JobFileExtension', 'doc,pdf', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(25, 'DateFormat', 'jS M y', '2017-06-14 00:16:47', '2017-06-14 00:16:47'),
(26, 'Language', '1', '2017-06-14 00:16:47', '2017-06-14 00:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `sys_attendance`
--

CREATE TABLE `sys_attendance` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `date` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `clock_in` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clock_in_optional` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clock_out` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `late` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `early_leaving` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overtime` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Absent','Holiday','Present') COLLATE utf8_unicode_ci NOT NULL,
  `pay_status` enum('Paid','Unpaid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `clock_status` enum('Clock In','Clock Out') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Clock Out',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_award`
--

CREATE TABLE `sys_award` (
  `id` int(10) UNSIGNED NOT NULL,
  `award` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_award_list`
--

CREATE TABLE `sys_award_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` text COLLATE utf8_unicode_ci NOT NULL,
  `award` int(11) NOT NULL,
  `gift` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `cash` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `month` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `year` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_department`
--

CREATE TABLE `sys_department` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_designation`
--

CREATE TABLE `sys_designation` (
  `id` int(10) UNSIGNED NOT NULL,
  `did` int(11) NOT NULL,
  `designation` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_disable_menu`
--

CREATE TABLE `sys_disable_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_ids` text COLLATE utf8_unicode_ci,
  `menu` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_disable_menu`
--

INSERT INTO `sys_disable_menu` (`id`, `emp_ids`, `menu`, `status`, `created_at`, `updated_at`) VALUES
(1, '', 'Departments', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(2, '', 'Designations', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(3, '', 'Employees', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(4, '', 'Job Application', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(5, '', 'Attendance', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(6, '', 'Leave', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(7, '', 'Holiday', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(8, '', 'Award', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(9, '', 'Notice Board', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(10, '', 'Expense', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(11, '', 'Payroll', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(12, '', 'Training', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(13, '', 'Task', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(14, '', 'Support Tickets', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(15, '', 'Reports', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28'),
(16, '', 'Settings', 'active', '2017-06-14 00:17:28', '2017-06-14 00:17:28');

-- --------------------------------------------------------

--
-- Table structure for table `sys_email_templates`
--

CREATE TABLE `sys_email_templates` (
  `id` int(10) UNSIGNED NOT NULL,
  `tplname` text COLLATE utf8_unicode_ci NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_email_templates`
--

INSERT INTO `sys_email_templates` (`id`, `tplname`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Employee SignUp', 'Welcome to {{business_name}}', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <div width=\"125\" height=\"23\" style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\">{{business_name}}</div>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Welcome to {{business_name}}! This message is an automated reply to your Employee Access request. Login to your employee panel by using the details below:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\"{{sys_url}}\">{{sys_url}}</a>.<br>\n                                    User Name: {{username}}<br>\n                                    Password: {{password}}\n            <br>\n            Regards,<br>\n            {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '1', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(2, 'Ticket For Employee', 'New Ticket From {{business_name}}', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <div width=\"125\" height=\"23\" style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\" >{{business_name}}</div>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Thank you for stay with us! This is a Support Ticket For Yours.. Login to your account to view  your support tickets details:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\"{{sys_url}}\">{{sys_url}}</a>.<br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Created By: {{create_by}}\n            <br>\n            Regards,<br>\n            {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">Â </td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">Â </td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright Â© {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n\n                ', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(3, 'Admin Password Reset', '{{business_name}} New Password', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <p  style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\">{{business_name}}</p>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfully!   This message is an automated reply to your password reset request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\" {{sys_url}}\"> {{sys_url}}</a>.<br>\n                                    User Name: {{username}}<br>\n                                    Password: {{password}}\n            <br>\n            {{business_name}},<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(4, 'Forgot Admin Password', '{{business_name}} password change request', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <p  style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\" >{{business_name}}</p>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfully!   This message is an automated reply to your password reset request. Click this linke to reset your password:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\" {{forgotpw_link}} \"> {{forgotpw_link}} </a>.<br>\nNotes: Until your password has been changed, your current password will remain valid. The Forgot Password Link will be available for a limited time only.\n\n            <br>\n            On behalf of the {{business_name}},<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(5, 'Ticket Reply', 'Reply to Ticket [TID-{{ticket_id}}]', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <div width=\"125\" height=\"23\" style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\"  {{business_name}} ></div>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Thank you for stay with us! This is a Support Ticket Reply. Login to your account to view  your support ticket reply details:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\"{{sys_url}}\">{{sys_url}}</a>.<br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Replyed By: {{reply_by}} <br><br>\n                Should you have any questions in regards to this support ticket or any other tickets related issue, please feel free to contact the Support department by creating a new ticket from your Employee Portal\n            <br><br>\n            Regards,<br>\n            {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49');
INSERT INTO `sys_email_templates` (`id`, `tplname`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Forgot Employee Password', '{{business_name}} password change request', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <p  style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\">{{business_name}} </p>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfully!   This message is an automated reply to your password reset request. Click this linke to reset your password:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\" {{forgotpw_link}} \"> {{forgotpw_link}} </a>.<br>\nNotes: Until your password has been changed, your current password will remain valid. The Forgot Password Link will be available for a limited time only.\n\n            <br>\n            {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(7, 'Employee Password Reset', '{{business_name}} New Password', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <p  style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\" >{{business_name}}</p>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>\n                 <br>\n                Password Reset Successfully!   This message is an automated reply to your password reset request. Login to your account to set up your all details by using the details below:\n            <br>\n                <a target=\"_blank\" style=\"color:#ff6600;font-weight:bold;font-family:helvetica,arial,sans-seif;text-decoration:none\" href=\" {{sys_url}}\"> {{sys_url}}</a>.<br>\n                                    User Name: {{username}}<br>\n                                    Password: {{password}}\n            <br>\n            {{business_name}}<br>\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(8, 'Ticket For Admin', 'New Ticket From {{business_name}} Employee', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <div width=\"125\" height=\"23\" style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\" >{{business_name}}</div>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>{{department_name}},<br>\n                 <br>\n\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Created By: {{create_by}} <br><br>\n                Waiting for your quick response.\n            <br><br>\n            Thank you.\n            <br>\n            Regards,<br>\n            {{name}}<br>\n{{business_name}} Employee.\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:49', '2017-06-14 00:16:49'),
(9, 'Employee Ticket Reply', 'Reply to Ticket [TID-{{ticket_id}}]', '<div style=\"margin:0;padding:0\">\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#439cc8\">\n  <tbody><tr>\n    <td align=\"center\">\n            <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n              <tbody><tr>\n                <td height=\"95\" bgcolor=\"#439cc8\" style=\"background:#439cc8;text-align:left\">\n                <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                      <tbody><tr>\n                        <td width=\"672\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                      </tr>\n                      <tr>\n                        <td style=\"text-align:left\">\n                        <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\">\n                          <tbody><tr>\n                            <td width=\"37\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\">\n                            </td>\n                            <td width=\"523\" height=\"24\" style=\"text-align:left\">\n                            <div width=\"125\" height=\"23\" style=\"display:block;color:#ffffff;font-size:20px;font-family:Arial,Helvetica,sans-serif;max-width:557px;min-height:auto\">{{business_name}}</div>\n                            </td>\n                            <td width=\"44\" style=\"text-align:left\"></td>\n                            <td width=\"30\" style=\"text-align:left\"></td>\n                            <td width=\"38\" height=\"24\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n                          </tr>\n                        </tbody></table>\n                        </td>\n                      </tr>\n                      <tr><td width=\"672\" height=\"33\" style=\"font-size:33px;line-height:33px;height:33px;text-align:left\"></td></tr>\n                    </tbody></table>\n\n                </td>\n              </tr>\n            </tbody></table>\n     </td>\n    </tr>\n </tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" bgcolor=\"#439cc8\"><tbody><tr><td height=\"5\" style=\"background:#439cc8;height:5px;font-size:5px;line-height:5px\"></td></tr></tbody></table>\n\n <table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#e9eff0\">\n  <tbody><tr>\n    <td align=\"center\">\n      <table cellspacing=\"0\" cellpadding=\"0\" width=\"671\" border=\"0\" bgcolor=\"#e9eff0\" style=\"background:#e9eff0\">\n        <tbody><tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n          <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"596\" border=\"0\" bgcolor=\"#ffffff\">\n            <tbody><tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n              <td width=\"556\" style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\" style=\"font-family:helvetica,arial,sans-seif;color:#666666;font-size:16px;line-height:22px\">\n                <tbody><tr>\n                  <td style=\"text-align:left\"></td>\n                </tr>\n                <tr>\n                  <td style=\"text-align:left\"><table cellspacing=\"0\" cellpadding=\"0\" width=\"556\" border=\"0\">\n                    <tbody><tr><td style=\"font-family:helvetica,arial,sans-serif;font-size:30px;line-height:40px;font-weight:normal;color:#253c44;text-align:left\"></td></tr>\n                    <tr><td width=\"556\" height=\"20\" style=\"font-size:20px;line-height:20px;height:20px;text-align:left\"></td></tr>\n                    <tr>\n                      <td style=\"text-align:left\">\n                 Hi {{name}},<br>{{department_name}},<br>\n                 <br>\n                 This is a Support Ticket Reply From Cleint.\n            <br>\n                Ticket ID: {{ticket_id}}<br>\n                Ticket Subject: {{ticket_subject}}<br>\n                Message: {{message}}<br>\n                Replyed By: {{reply_by}}  <br><br>\n                Waiting for your quick response.\n            <br><br>\n            Thank you.\n            <br>\n            Regards,<br>\n            {{name}}<br>\n{{business_name}} Employee.\n            <br>\n          </td>\n                    </tr>\n                    <tr>\n                      <td width=\"556\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\">&nbsp;</td>\n                    </tr>\n                  </tbody></table></td>\n                </tr>\n              </tbody></table></td>\n              <td width=\"20\" height=\"26\" style=\"font-size:26px;line-height:26px;height:26px;text-align:left\"></td>\n            </tr>\n            <tr>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"556\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n              <td width=\"20\" height=\"2\" bgcolor=\"#d9dfe1\" style=\"background-color:#d9dfe1;font-size:2px;line-height:2px;height:2px;text-align:left\"></td>\n            </tr>\n          </tbody></table></td>\n          <td width=\"37\" height=\"40\" style=\"font-size:40px;line-height:40px;height:40px;text-align:left\"></td>\n        </tr>\n        <tr>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"596\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"37\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n        </tr>\n      </tbody></table>\n  </td></tr>\n</tbody>\n</table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#273f47\"><tbody><tr><td align=\"center\">&nbsp;</td></tr></tbody></table>\n<table cellspacing=\"0\" cellpadding=\"0\" width=\"100%\" border=\"0\" bgcolor=\"#364a51\">\n  <tbody><tr>\n    <td align=\"center\">\n       <table cellspacing=\"0\" cellpadding=\"0\" width=\"672\" border=\"0\" bgcolor=\"#364a51\">\n              <tbody><tr>\n              <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"569\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n          <td width=\"38\" height=\"30\" style=\"font-size:30px;line-height:30px;height:30px;text-align:left\"></td>\n              </tr>\n              <tr>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\">\n                </td>\n                <td valign=\"top\" style=\"font-family:helvetica,arial,sans-seif;font-size:12px;line-height:16px;color:#949fa3;text-align:left\">Copyright &copy; {{business_name}}, All rights reserved.<br><br><br></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n              <tr>\n              <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              <td width=\"569\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n                <td width=\"38\" height=\"40\" style=\"font-size:40px;line-height:40px;text-align:left\"></td>\n              </tr>\n            </tbody></table>\n     </td>\n  </tr>\n</tbody></table><div class=\"yj6qo\"></div><div class=\"adL\">\n\n</div></div>\n', '0', '2017-06-14 00:16:50', '2017-06-14 00:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee`
--

CREATE TABLE `sys_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `fname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employee_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `father_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `dol` date DEFAULT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pre_address` text COLLATE utf8_unicode_ci,
  `per_address` text COLLATE utf8_unicode_ci,
  `avatar` text COLLATE utf8_unicode_ci,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` enum('Monthly','Hourly') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Hourly',
  `basic_salary` decimal(10,2) NOT NULL DEFAULT '0.00',
  `overtime_salary` decimal(10,2) NOT NULL DEFAULT '0.00',
  `basic_salary_increment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `overtime_salary_increment` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tax_id` int(11) NOT NULL,
  `working_hourly_rate` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `overtime_hourly_rate` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `working_hourly_increment_rate` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `overtime_hourly_increment_rate` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `passwordresetkey` text COLLATE utf8_unicode_ci,
  `remember_token` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_employee`
--

INSERT INTO `sys_employee` (`id`, `fname`, `lname`, `employee_code`, `designation`, `department`, `role_id`, `user_name`, `email`, `password`, `father_name`, `mother_name`, `dob`, `doj`, `dol`, `phone`, `phone2`, `pre_address`, `per_address`, `avatar`, `status`, `gender`, `payment_type`, `basic_salary`, `overtime_salary`, `basic_salary_increment`, `overtime_salary_increment`, `tax_id`, `working_hourly_rate`, `overtime_hourly_rate`, `working_hourly_increment_rate`, `overtime_hourly_increment_rate`, `passwordresetkey`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abul Kashem', 'Shamim', '5239139481', 1, 1, 1, 'admin', 'admin@gmail.com', '$2y$10$.6e.eBM5wOiet6HccNrRHuku1ekVbL2AYeVpNySR4ZnROlqpH5mte', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'active', 'Male', 'Hourly', '0.00', '0.00', '0.00', '0.00', 1, '0', '0', '0', '0', NULL, '6pjIY3C1g7', '2017-06-14 00:16:48', '2017-06-14 00:16:48');

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee_bank_accounts`
--

CREATE TABLE `sys_employee_bank_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `bank_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `account_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ifsc_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pan_no` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee_files`
--

CREATE TABLE `sys_employee_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `file_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee_roles`
--

CREATE TABLE `sys_employee_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee_roles_permission`
--

CREATE TABLE `sys_employee_roles_permission` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `perm_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_employee_training`
--

CREATE TABLE `sys_employee_training` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `trainer` int(11) DEFAULT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `sponsored_by` text COLLATE utf8_unicode_ci,
  `organized_by` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_expense`
--

CREATE TABLE `sys_expense` (
  `id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `purchase_from` text COLLATE utf8_unicode_ci,
  `purchase_date` date NOT NULL,
  `purchase_by` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Approved','Cancel') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `bill_copy` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_expense_title`
--

CREATE TABLE `sys_expense_title` (
  `id` int(10) UNSIGNED NOT NULL,
  `expense` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_holiday`
--

CREATE TABLE `sys_holiday` (
  `id` int(10) UNSIGNED NOT NULL,
  `holiday` date NOT NULL,
  `occasion` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_jobs`
--

CREATE TABLE `sys_jobs` (
  `id` int(10) UNSIGNED NOT NULL,
  `position` int(11) NOT NULL,
  `no_position` int(11) NOT NULL,
  `job_type` enum('Contractual','Part Time','Full Time') COLLATE utf8_unicode_ci DEFAULT NULL,
  `experience` text COLLATE utf8_unicode_ci,
  `age` text COLLATE utf8_unicode_ci,
  `job_location` text COLLATE utf8_unicode_ci,
  `salary_range` text COLLATE utf8_unicode_ci,
  `short_description` text COLLATE utf8_unicode_ci,
  `post_date` date NOT NULL,
  `apply_date` date DEFAULT NULL,
  `close_date` date DEFAULT NULL,
  `status` enum('opening','closed','drafted') COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_job_applicants`
--

CREATE TABLE `sys_job_applicants` (
  `id` int(10) UNSIGNED NOT NULL,
  `job_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Unread','Rejected','Primary Selected','Call For Interview','Confirm') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unread',
  `resume` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_language`
--

CREATE TABLE `sys_language` (
  `id` int(10) UNSIGNED NOT NULL,
  `language` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `icon` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_language`
--

INSERT INTO `sys_language` (`id`, `language`, `status`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'English', 'Active', 'us.gif', '2017-06-14 00:16:50', '2017-06-14 00:16:50');

-- --------------------------------------------------------

--
-- Table structure for table `sys_language_data`
--

CREATE TABLE `sys_language_data` (
  `id` int(10) UNSIGNED NOT NULL,
  `lan_id` int(11) NOT NULL,
  `lan_data` text COLLATE utf8_unicode_ci NOT NULL,
  `lan_value` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_language_data`
--

INSERT INTO `sys_language_data` (`id`, `lan_id`, `lan_data`, `lan_value`, `created_at`, `updated_at`) VALUES
(1, 1, 'Login', 'Login', '2017-06-14 00:16:50', '2017-06-14 00:16:50'),
(2, 1, 'Forget Password', 'Forget Password', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(3, 1, 'Sign to your account', 'Sign to your account', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(4, 1, 'User Name', 'User Name', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(5, 1, 'Password', 'Password', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(6, 1, 'Remember Me', 'Remember Me', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(7, 1, 'Reset your password', 'Reset your password', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(8, 1, 'Email', 'Email', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(9, 1, 'Reset My Password', 'Reset My Password', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(10, 1, 'Back To Sign in', 'Back To Sign in', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(11, 1, 'Dashboard', 'Dashboard', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(12, 1, 'Departments', 'Departments', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(13, 1, 'Designations', 'Designations', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(14, 1, 'Employees', 'Employees', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(15, 1, 'All Employees', 'All Employees', '2017-06-14 00:16:51', '2017-06-14 00:16:51'),
(16, 1, 'Add Employee', 'Add Employee', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(17, 1, 'Job Application', 'Job Application', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(18, 1, 'Attendance', 'Attendance', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(19, 1, 'Attendance Report', 'Attendance Report', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(20, 1, 'Update Attendance', 'Update Attendance', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(21, 1, 'Leave', 'Leave', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(22, 1, 'Holiday', 'Holiday', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(23, 1, 'Holiday Calender', 'Holiday Calender', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(24, 1, 'Add New Holiday', 'Add New Holiday', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(25, 1, 'Award', 'Award', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(26, 1, 'Notice Board', 'Notice Board', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(27, 1, 'Expense', 'Expense', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(28, 1, 'Payroll', 'Payroll', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(29, 1, 'Employee Salary List', 'Employee Salary List', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(30, 1, 'Make Payment', 'Make Payment', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(31, 1, 'Generate Payslip', 'Generate Payslip', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(32, 1, 'Task', 'Task', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(33, 1, 'Support Tickets', 'Support Tickets', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(34, 1, 'All Support Tickets', 'All Support Tickets', '2017-06-14 00:16:52', '2017-06-14 00:16:52'),
(35, 1, 'Create New Ticket', 'Create New Ticket', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(36, 1, 'Support Department', 'Support Department', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(37, 1, 'Settings', 'Settings', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(38, 1, 'System Settings', 'System Settings', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(39, 1, 'Localization', 'Localization', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(40, 1, 'Email Templates', 'Email Templates', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(41, 1, 'Language Settings', 'Language Settings', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(42, 1, 'Recent 5 Leave Applications', 'Recent 5 Leave Applications', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(43, 1, 'See All Applications', 'See All Applications', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(44, 1, 'Recent 5 Pending Tasks', 'Recent 5 Pending Tasks', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(45, 1, 'See All Tasks', 'See All Tasks', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(46, 1, 'Recent 5 Pending Tickets', 'Recent 5 Pending Tickets', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(47, 1, 'See All Tickets', 'See All Tickets', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(48, 1, 'Update Profile', 'Update Profile', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(49, 1, 'Change Password', 'Change Password', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(50, 1, 'Logout', 'Logout', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(51, 1, 'Department', 'Department', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(52, 1, 'Add Department', 'Add Department', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(53, 1, 'Account Department', 'Account Department', '2017-06-14 00:16:53', '2017-06-14 00:16:53'),
(54, 1, 'Add', 'Add', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(55, 1, 'All Departments', 'All Departments', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(56, 1, 'SL', 'SL', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(57, 1, 'Department Name', 'Department Name', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(58, 1, 'Actions', 'Actions', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(59, 1, 'Edit', 'Edit', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(60, 1, 'Delete', 'Delete', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(61, 1, 'Designations', 'Designations', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(62, 1, 'Add Designation', 'Add Designation', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(63, 1, 'Designation Name', 'Designation Name', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(64, 1, 'Software Engineer', 'Software Engineer', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(65, 1, 'All Designations', 'All Designations', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(66, 1, 'Designation', 'Designation', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(67, 1, 'Code', 'Code', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(68, 1, 'Name', 'Name', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(69, 1, 'Username', 'Username', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(70, 1, 'Status', 'Status', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(71, 1, 'Active', 'Active', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(72, 1, 'Inactive', 'Inactive', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(73, 1, 'First Name', 'First Name', '2017-06-14 00:16:54', '2017-06-14 00:16:54'),
(74, 1, 'Last Name', 'Last Name', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(75, 1, 'Employee Code', 'Employee Code', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(76, 1, 'Unique For every User', 'Unique For every User', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(77, 1, 'Confirm Password', 'Confirm Password', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(78, 1, 'Select Department', 'Select Department', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(79, 1, 'User Role', 'User Role', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(80, 1, 'Admin', 'Admin', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(81, 1, 'Employee', 'Employee', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(82, 1, 'View Profile', 'View Profile', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(83, 1, 'Phone', 'Phone', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(84, 1, 'Address', 'Address', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(85, 1, 'Personal Details', 'Personal Details', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(86, 1, 'Bank Info', 'Bank Info', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(87, 1, 'Document', 'Document', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(88, 1, 'Change Picture', 'Change Picture', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(89, 1, 'Leave blank if you no need to change password', 'Leave blank if you no need to change password', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(90, 1, 'Date Of Join', 'Date Of Join', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(91, 1, 'Date Of Leave', 'Date Of Leave', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(92, 1, 'Phone Number', 'Phone Number', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(93, 1, 'Alternative Phone', 'Alternative Phone', '2017-06-14 00:16:55', '2017-06-14 00:16:55'),
(94, 1, 'Father Name', 'Father Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(95, 1, 'Mother Name', 'Mother Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(96, 1, 'Date Of Birth', 'Date Of Birth', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(97, 1, 'Present Address', 'Present Address', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(98, 1, 'Permanent Address', 'Permanent Address', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(99, 1, 'Update', 'Update', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(100, 1, 'Add Bank Account', 'Add Bank Account', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(101, 1, 'Bank Name', 'Bank Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(102, 1, 'Branch Name', 'Branch Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(103, 1, 'Account Name', 'Account Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(104, 1, 'Account Number', 'Account Number', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(105, 1, 'IFSC Code', 'IFSC Code', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(106, 1, 'PAN Number', 'PAN Number', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(107, 1, 'All Bank Accounts', 'All Bank Accounts', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(108, 1, 'Branch', 'Branch', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(109, 1, 'Account No', 'Account No', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(110, 1, 'PAN No', 'PAN No', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(111, 1, 'Add Document', 'Add Document', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(112, 1, 'Document Name', 'Document Name', '2017-06-14 00:16:56', '2017-06-14 00:16:56'),
(113, 1, 'Select Document', 'Select Document', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(114, 1, 'Browse', 'Browse', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(115, 1, 'All Documents', 'All Documents', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(116, 1, 'Download', 'Download', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(117, 1, 'Job Applications', 'Job Applications', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(118, 1, 'Add New Job', 'Add New Job', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(119, 1, 'Position', 'Position', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(120, 1, 'Posted Date', 'Posted Date', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(121, 1, 'Apply Last Date', 'Apply Last Date', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(122, 1, 'Close Date', 'Close Date', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(123, 1, 'Open', 'Open', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(124, 1, 'Drafted', 'Drafted', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(125, 1, 'Closed', 'Closed', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(126, 1, 'Applicants', 'Applicants', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(127, 1, 'Number Of Post', 'Number Of Post', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(128, 1, 'Post Date', 'Post Date', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(129, 1, 'Last Date To Apply', 'Last Date To Apply', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(130, 1, 'Description', 'Description', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(131, 1, 'Close', 'Close', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(132, 1, 'Search Condition', 'Search Condition', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(133, 1, 'Date', 'Date', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(134, 1, 'Select Employee', 'Select Employee', '2017-06-14 00:16:57', '2017-06-14 00:16:57'),
(135, 1, 'Select Designation', 'Select Designation', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(136, 1, 'Search', 'Search', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(137, 1, 'Employee Name', 'Employee Name', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(138, 1, 'Clock In', 'Clock In', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(139, 1, 'Clock Out', 'Clock Out', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(140, 1, 'Late', 'Late', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(141, 1, 'Early Leaving', 'Early Leaving', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(142, 1, 'Overtime', 'Overtime', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(143, 1, 'Total Work', 'Total Work', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(144, 1, 'Absent', 'Absent', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(145, 1, 'Present', 'Present', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(146, 1, 'Set Overtime', 'Set Overtime', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(147, 1, 'Leave Application', 'Leave Application', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(148, 1, 'Leave Type', 'Leave Type', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(149, 1, 'Leave From', 'Leave From', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(150, 1, 'Leave To', 'Leave To', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(151, 1, 'Approved', 'Approved', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(152, 1, 'Pending', 'Pending', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(153, 1, 'Rejected', 'Rejected', '2017-06-14 00:16:58', '2017-06-14 00:16:58'),
(154, 1, 'View', 'View', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(155, 1, 'View Application', 'View Application', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(156, 1, 'Applied On', 'Applied On', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(157, 1, 'Leave Reason', 'Leave Reason', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(158, 1, 'Current Status', 'Current Status', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(159, 1, 'Change Status', 'Change Status', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(160, 1, 'Remark', 'Remark', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(161, 1, 'Update', 'Update', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(162, 1, 'Prev', 'Prev', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(163, 1, 'This Month', 'This Month', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(164, 1, 'Next', 'Next', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(165, 1, 'Occasion Name', 'Occasion Name', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(166, 1, 'Occasion', 'Occasion', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(167, 1, 'Award List', 'Award List', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(168, 1, 'Add New Award', 'Add New Award', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(169, 1, 'Award Name', 'Award Name', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(170, 1, 'Gift', 'Gift', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(171, 1, 'Month', 'Month', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(172, 1, 'Gift Item', 'Gift Item', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(173, 1, 'Cash Price', 'Cash Price', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(174, 1, 'January', 'January', '2017-06-14 00:16:59', '2017-06-14 00:16:59'),
(175, 1, 'February', 'February', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(176, 1, 'March', 'March', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(177, 1, 'April', 'April', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(178, 1, 'May', 'May', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(179, 1, 'June', 'June', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(180, 1, 'July', 'July', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(181, 1, 'August', 'August', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(182, 1, 'September', 'September', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(183, 1, 'October', 'October', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(184, 1, 'November', 'November', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(185, 1, 'December', 'December', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(186, 1, 'Year', 'Year', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(187, 1, 'Edit Award', 'Edit Award', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(188, 1, 'Add New Notice', 'Add New Notice', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(189, 1, 'Title', 'Title', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(190, 1, 'Published', 'Published', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(191, 1, 'Unpublished', 'Unpublished', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(192, 1, 'Notice Title', 'Notice Title', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(193, 1, 'Notice Status', 'Notice Status', '2017-06-14 00:17:00', '2017-06-14 00:17:00'),
(194, 1, 'Edit Notice', 'Edit Notice', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(195, 1, 'Expense List', 'Expense List', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(196, 1, 'Add New Expense', 'Add New Expense', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(197, 1, 'Item Name', 'Item Name', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(198, 1, 'Purchase From', 'Purchase From', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(199, 1, 'Purchase Date', 'Purchase Date', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(200, 1, 'Amount', 'Amount', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(201, 1, 'Cancel', 'Cancel', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(202, 1, 'Bill Copy', 'Bill Copy', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(203, 1, 'Purchase By', 'Purchase By', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(204, 1, 'Edit Expense', 'Edit Expense', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(205, 1, 'Working Hourly Rate', 'Working Hourly Rate', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(206, 1, 'Overtime Hourly Rate', 'Overtime Hourly Rate', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(207, 1, 'Edit Employee Salary', 'Edit Employee Salary', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(208, 1, 'Hourly Working Rate', 'Hourly Working Rate', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(209, 1, 'Hourly Overtime Rate', 'Hourly Overtime Rate', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(210, 1, 'Payment Amount', 'Payment Amount', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(211, 1, 'Details', 'Details', '2017-06-14 00:17:01', '2017-06-14 00:17:01'),
(212, 1, 'Pay Payment', 'Pay Payment', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(213, 1, 'Payment For', 'Payment For', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(214, 1, 'Net Salary', 'Net Salary', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(215, 1, 'Overtime Salary', 'Overtime Salary', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(216, 1, 'Payment Type', 'Payment Type', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(217, 1, 'Cash Payment', 'Cash Payment', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(218, 1, 'Bank Payment', 'Bank Payment', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(219, 1, 'Cheque Payment', 'Cheque Payment', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(220, 1, 'Pay', 'Pay', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(221, 1, 'All Payments', 'All Payments', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(222, 1, 'Payment Month', 'Payment Month', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(223, 1, 'Payment Date', 'Payment Date', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(224, 1, 'Paid Amount', 'Paid Amount', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(225, 1, 'Payslip', 'Payslip', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(226, 1, 'Task List', 'Task List', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(227, 1, 'Add New Task', 'Add New Task', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(228, 1, 'Created Date', 'Created Date', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(229, 1, 'Due Date', 'Due Date', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(230, 1, 'Completed', 'Completed', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(231, 1, 'Started', 'Started', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(232, 1, 'Task Title', 'Task Title', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(233, 1, 'Assign To', 'Assign To', '2017-06-14 00:17:02', '2017-06-14 00:17:02'),
(234, 1, 'Start Date', 'Start Date', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(235, 1, 'Estimated Hour', 'Estimated Hour', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(236, 1, 'Progress', 'Progress', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(237, 1, 'Edit Task', 'Edit Task', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(238, 1, 'Manage Task', 'Manage Task', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(239, 1, 'Task Basic Info', 'Task Basic Info', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(240, 1, 'Task Management', 'Task Management', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(241, 1, 'Task Details', 'Task Details', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(242, 1, 'Task Discussion', 'Task Discussion', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(243, 1, 'Task Files', 'Task Files', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(244, 1, 'Task Description', 'Task Description', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(245, 1, 'Task Members', 'Task Members', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(246, 1, 'Leave Comment', 'Leave Comment', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(247, 1, 'Reply', 'Reply', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(248, 1, 'Member', 'Member', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(249, 1, 'Comment', 'Comment', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(250, 1, 'Last Update', 'Last Update', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(251, 1, 'File Title', 'File Title', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(252, 1, 'Files', 'Files', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(253, 1, 'Upload', 'Upload', '2017-06-14 00:17:03', '2017-06-14 00:17:03'),
(254, 1, 'Size', 'Size', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(255, 1, 'Upload By', 'Upload By', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(256, 1, 'Select File', 'Select File', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(257, 1, 'Subject', 'Subject', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(258, 1, 'Answered', 'Answered', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(259, 1, 'Customer Reply', 'Customer Reply', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(260, 1, 'Department Email', 'Department Email', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(261, 1, 'Show in Client', 'Show in Client', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(262, 1, 'Yes', 'Yes', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(263, 1, 'No', 'No', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(264, 1, 'Add New', 'Add New', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(265, 1, 'Manage', 'Manage', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(266, 1, 'View Department', 'View Department', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(267, 1, 'Ticket For Client', 'Ticket For Client', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(268, 1, 'Message', 'Message', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(269, 1, 'Create Ticket', 'Create Ticket', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(270, 1, 'Manage Support Ticket', 'Manage Support Ticket', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(271, 1, 'Change Basic Info', 'Change Basic Info', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(272, 1, 'Change Department', 'Change Department', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(273, 1, 'Ticket Management', 'Ticket Management', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(274, 1, 'Ticket Details', 'Ticket Details', '2017-06-14 00:17:04', '2017-06-14 00:17:04'),
(275, 1, 'Ticket Discussion', 'Ticket Discussion', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(276, 1, 'Ticket Files', 'Ticket Files', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(277, 1, 'Ticket For', 'Ticket For', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(278, 1, 'Created By', 'Created By', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(279, 1, 'Closed By', 'Closed By', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(280, 1, 'Reply Ticket', 'Reply Ticket', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(281, 1, 'General', 'General', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(282, 1, 'Office Time', 'Office Time', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(283, 1, 'Job', 'Job', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(284, 1, 'Application Name', 'Application Name', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(285, 1, 'Application Title', 'Application Title', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(286, 1, 'System Email', 'System Email', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(287, 1, 'Remember: All Email Going to the Receiver from this Email', 'Remember: All Email Going to the Receiver from this Email', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(288, 1, 'Footer Text', 'Footer Text', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(289, 1, 'Application Logo', 'Application Logo', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(290, 1, 'Application Favicon', 'Application Favicon', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(291, 1, 'Email Gateway', 'Email Gateway', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(292, 1, 'SMTP Host Name', 'SMTP Host Name', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(293, 1, 'SMTP User Name', 'SMTP User Name', '2017-06-14 00:17:05', '2017-06-14 00:17:05'),
(294, 1, 'SMTP Password', 'SMTP Password', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(295, 1, 'SMTP Port', 'SMTP Port', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(296, 1, 'SMTP Secure', 'SMTP Secure', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(297, 1, 'Office In Time', 'Office In Time', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(298, 1, 'Office Out Time', 'Office Out Time', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(299, 1, 'Add New Expense Title', 'Add New Expense Title', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(300, 1, 'Expense Title', 'Expense Title', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(301, 1, 'Employee Salary', 'Employee Salary', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(302, 1, 'Expense Title List', 'Expense Title List', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(303, 1, 'Leave Title', 'Leave Title', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(304, 1, 'Sick Leave', 'Sick Leave', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(305, 1, 'Leave Quota', 'Leave Quota', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(306, 1, 'Leave Title List', 'Leave Title List', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(307, 1, 'Best Employee', 'Best Employee', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(308, 1, 'Job File Extension', 'Job File Extension', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(309, 1, 'Supported File Extension', 'Supported File Extension', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(310, 1, 'Remember: File Extension Separated By Comma', 'Remember: File Extension Separated By Comma', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(311, 1, 'Award Name List', 'Award Name List', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(312, 1, 'Save', 'Save', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(313, 1, 'Default Country', 'Default Country', '2017-06-14 00:17:06', '2017-06-14 00:17:06'),
(314, 1, 'Date Format', 'Date Format', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(315, 1, 'Default Language', 'Default Language', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(316, 1, 'Current Code', 'Current Code', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(317, 1, 'Current Symbol', 'Current Symbol', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(318, 1, 'Email Templates', 'Email Templates', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(319, 1, 'Template Name', 'Template Name', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(320, 1, 'Manage Email Template', 'Manage Email Template', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(321, 1, 'Language', 'Language', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(322, 1, 'Add Language', 'Add Language', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(323, 1, 'Language Name', 'Language Name', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(324, 1, 'Flag', 'Flag', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(325, 1, 'All Languages', 'All Languages', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(326, 1, 'Translate', 'Translate', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(327, 1, 'To', 'To', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(328, 1, 'Current Password', 'Current Password', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(329, 1, 'New Password', 'New Password', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(330, 1, 'All Leave Details', 'All Leave Details', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(331, 1, 'Total Leave', 'Total Leave', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(332, 1, 'New Leave', 'New Leave', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(333, 1, 'Request For New Leave', 'Request For New Leave', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(334, 1, 'Send', 'Send', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(335, 1, 'Published Date', 'Published Date', '2017-06-14 00:17:07', '2017-06-14 00:17:07'),
(336, 1, 'Payment History', 'Payment History', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(337, 1, 'Payment Salary Details', 'Payment Salary Details', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(338, 1, 'Print Payslip', 'Print Payslip', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(339, 1, 'Salary Month', 'Salary Month', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(340, 1, 'Employee ID', 'Employee ID', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(341, 1, 'Payslip NO', 'Payslip NO', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(342, 1, 'Joining Date', 'Joining Date', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(343, 1, 'Payment By', 'Payment By', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(344, 1, 'Payment Details', 'Payment Details', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(345, 1, 'Earning', 'Earning', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(346, 1, 'Grand Total', 'Grand Total', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(347, 1, 'Overtime Amount', 'Overtime Amount', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(348, 1, 'Job Type', 'Job Type', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(349, 1, 'Contractual', 'Contractual', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(350, 1, 'Part Time', 'Part Time', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(351, 1, 'Full Time', 'Full Time', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(352, 1, 'Experience', 'Experience', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(353, 1, 'Age', 'Age', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(354, 1, 'Job Location', 'Job Location', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(355, 1, 'Salary Range', 'Salary Range', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(356, 1, 'Short Description', 'Short Description', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(357, 1, 'Edit Job', 'Edit Job', '2017-06-14 00:17:08', '2017-06-14 00:17:08'),
(358, 1, 'All Jobs', 'All Jobs', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(359, 1, 'Home', 'Home', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(360, 1, 'Jobs', 'Jobs', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(361, 1, 'Deadline', 'Deadline', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(362, 1, 'Job Summary', 'Job Summary', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(363, 1, 'Published on', 'Published on', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(364, 1, 'Application Deadline', 'Application Deadline', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(365, 1, 'Apply Now', 'Apply Now', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(366, 1, 'Apply For', 'Apply For', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(367, 1, 'Upload Resume', 'Upload Resume', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(368, 1, 'Apply', 'Apply', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(369, 1, 'Language Manage', 'Language Manage', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(370, 1, 'View All', 'View All', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(371, 1, 'Expense Request', 'Expense Request', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(372, 1, 'Recent', 'Recent', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(373, 1, 'Tasks', 'Tasks', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(374, 1, 'Timezone', 'Timezone', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(375, 1, 'Today is', 'Today is', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(376, 1, 'Time', 'Time', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(377, 1, 'Notice', 'Notice', '2017-06-14 00:17:09', '2017-06-14 00:17:09'),
(378, 1, 'Total', 'Total', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(379, 1, 'Subtotal', 'Subtotal', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(380, 1, 'TAX', 'TAX', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(381, 1, 'Edit Department', 'Edit Department', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(382, 1, 'Job Applicants', 'Job Applicants', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(383, 1, 'Unread', 'Unread', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(384, 1, 'Primary Selected', 'Primary Selected', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(385, 1, 'Call For Interview', 'Call For Interview', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(386, 1, 'Confirm', 'Confirm', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(387, 1, 'Rejected', 'Rejected', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(388, 1, 'Resume', 'Resume', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(389, 1, 'Status', 'Status', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(390, 1, 'View Holiday', 'View Holiday', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(391, 1, 'Tax Rules', 'Tax Rules', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(392, 1, 'Add Tax Rule', 'Add Tax Rule', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(393, 1, 'Tax Rule Name', 'Tax Rule Name', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(394, 1, 'Set Rules', 'Set Rules', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(395, 1, 'Save Values', 'Save Values', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(396, 1, 'Salary From', 'Salary From', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(397, 1, 'Salary To', 'Salary To', '2017-06-14 00:17:10', '2017-06-14 00:17:10'),
(398, 1, 'Tax Percentage', 'Tax Percentage', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(399, 1, 'Additional Tax Amount', 'Additional Tax Amount', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(400, 1, 'Gender', 'Gender', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(401, 1, 'Both', 'Both', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(402, 1, 'Male', 'Male', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(403, 1, 'Female', 'Female', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(404, 1, 'Remove', 'Remove', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(405, 1, 'Add More', 'Add More', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(406, 1, 'Provident Fund', 'Provident Fund', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(407, 1, 'Provident Fund Type', 'Provident Fund Type', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(408, 1, 'Employee Share', 'Employee Share', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(409, 1, 'Organization Share', 'Organization Share', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(410, 1, 'Paid', 'Paid', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(411, 1, 'Unpaid', 'Unpaid', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(412, 1, 'Loan', 'Loan', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(413, 1, 'Repayment Start Date', 'Repayment Start Date', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(414, 1, 'Remaining Amount', 'Remaining Amount', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(415, 1, 'Ongoing', 'Ongoing', '2017-06-14 00:17:11', '2017-06-14 00:17:11'),
(416, 1, 'Include Loan Amount in Payslip', 'Include Loan Amount in Payslip', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(417, 1, 'Monthly Repayment Amount', 'Monthly Repayment Amount', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(418, 1, 'Employee Salary Increment', 'Employee Salary Increment', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(419, 1, 'SMS Gateways', 'SMS Gateways', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(420, 1, 'Gateway Name', 'Gateway Name', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(421, 1, 'API Link', 'API Link', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(422, 1, 'Tax Template', 'Tax Template', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(423, 1, 'Salary Type', 'Salary Type', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(424, 1, 'Monthly', 'Monthly', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(425, 1, 'Hourly', 'Hourly', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(426, 1, 'Basic Salary', 'Basic Salary', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(427, 1, 'Overtime Salary', 'Overtime Salary', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(428, 1, 'Reports', 'Reports', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(429, 1, 'Employee Payroll Summery', 'Employee Payroll Summery', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(430, 1, 'No working hour', 'No working hour', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(431, 1, 'Add with basic salary', 'Add with basic salary', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(432, 1, 'Salary Statement', 'Salary Statement', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(433, 1, 'Date From', 'Date From', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(434, 1, 'Date To', 'Date To', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(435, 1, 'Find', 'Find', '2017-06-14 00:17:12', '2017-06-14 00:17:12'),
(436, 1, 'Send Email', 'Send Email', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(437, 1, 'Send SMS', 'Send SMS', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(438, 1, 'For', 'For', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(439, 1, 'Employee Summery', 'Employee Summery', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(440, 1, 'Set Working Rate', 'Set Working Rate', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(441, 1, 'Generate PDF', 'Generate PDF', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(442, 1, 'Training', 'Training', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(443, 1, 'Training Needs Assessment', 'Training Needs Assessment', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(444, 1, 'Training Events', 'Training Events', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(445, 1, 'Trainers', 'Trainers', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(446, 1, 'Trainer', 'Trainer', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(447, 1, 'Training Evaluations', 'Training Evaluations', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(448, 1, 'Add New Trainer', 'Add New Trainer', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(449, 1, 'Organization', 'Organization', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(450, 1, 'City', 'City', '2017-06-14 00:17:13', '2017-06-14 00:17:13'),
(451, 1, 'State', 'State', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(452, 1, 'Country', 'Country', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(453, 1, 'Zip Code', 'Zip Code', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(454, 1, 'Trainer Expertise', 'Trainer Expertise', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(455, 1, 'View Trainer Info', 'View Trainer Info', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(456, 1, 'Employee Training', 'Employee Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(457, 1, 'Add New Training', 'Add New Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(458, 1, 'Training Type', 'Training Type', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(459, 1, 'Training From', 'Training From', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(460, 1, 'Training To', 'Training To', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(461, 1, 'Online Training', 'Online Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(462, 1, 'Seminar', 'Seminar', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(463, 1, 'Lecture', 'Lecture', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(464, 1, 'Workshop', 'Workshop', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(465, 1, 'Hands On Training', 'Hands On Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(466, 1, 'Webinar', 'Webinar', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(467, 1, 'HR Training', 'HR Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(468, 1, 'Employees Development', 'Employees Development', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(469, 1, 'IT Training', 'IT Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(470, 1, 'Finance Training', 'Finance Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(471, 1, 'Nature Of Training', 'Nature Of Training', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(472, 1, 'Internal', 'Internal', '2017-06-14 00:17:14', '2017-06-14 00:17:14'),
(473, 1, 'External', 'External', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(474, 1, 'Training Location', 'Training Location', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(475, 1, 'Sponsored By', 'Sponsored By', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(476, 1, 'Organized By', 'Organized By', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(477, 1, 'View Employee Training', 'View Employee Training', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(478, 1, 'Preferred', 'Preferred', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(479, 1, 'End Date', 'End Date', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(480, 1, 'Reason', 'Reason', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(481, 1, 'Training Cost', 'Training Cost', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(482, 1, 'Travel Cost', 'Travel Cost', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(483, 1, 'Add New Event', 'Add New Event', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(484, 1, 'Upcoming', 'Upcoming', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(485, 1, 'Externals', 'Externals', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(486, 1, 'Employee Roles', 'Employee Roles', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(487, 1, 'Role Name', 'Role Name', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(488, 1, 'Set Roles', 'Set Roles', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(489, 1, 'My Portal', 'My Portal', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(490, 1, 'Disable Menu/Module', 'Disable Menu/Module', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(491, 1, 'Menu Name', 'Menu Name', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(492, 1, 'You do not have permission to view this page', 'You do not have permission to view this page', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(493, 1, 'Insert your time perfectly', 'Insert your time perfectly', '2017-06-14 00:17:15', '2017-06-14 00:17:15'),
(494, 1, 'Attendance Updated Successfully', 'Attendance Updated Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(495, 1, 'Attendance Info Not Found', 'Attendance Info Not Found', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(496, 1, 'Office time: In Time', 'Office time: In Time', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(497, 1, 'and Out Time', 'and Out Time', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(498, 1, 'This Option is Disable In Demo Mode', 'This Option is Disable In Demo Mode', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(499, 1, 'Attendance Deleted Successfully', 'Attendance Deleted Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(500, 1, 'Attendance Update Successfully', 'Attendance Update Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(501, 1, 'Award Added Successfully', 'Award Added Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(502, 1, 'Award Deleted Successfully', 'Award Deleted Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(503, 1, 'Award Not Found', 'Award Not Found', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(504, 1, 'Award Updated Successfully', 'Award Updated Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(505, 1, 'Department Added Successfully', 'Department Added Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(506, 1, 'Department Already Exist', 'Department Already Exist', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(507, 1, 'Department Updated Successfully', 'Department Updated Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(508, 1, 'Department Not Found', 'Department Not Found', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(509, 1, 'Employee added on this department. To remove; unassigned employee', 'Employee added on this department. To remove; unassigned employee', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(510, 1, 'Department Deleted Successfully', 'Department Deleted Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(511, 1, 'Designation Added Successfully', 'Designation Added Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(512, 1, 'Designation Already Exist', 'Designation Already Exist', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(513, 1, 'Employee added on this designation. To remove; unassigned employee', 'Employee added on this designation. To remove; unassigned employee', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(514, 1, 'Designation Deleted Successfully', 'Designation Deleted Successfully', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(515, 1, 'Designation Not Found', 'Designation Not Found', '2017-06-14 00:17:16', '2017-06-14 00:17:16'),
(516, 1, 'Designation Update Successfully', 'Designation Update Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(517, 1, 'Employee Code Already Exist', 'Employee Code Already Exist', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(518, 1, 'Username Already Exist', 'Username Already Exist', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(519, 1, 'Email Already Exist', 'Email Already Exist', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(520, 1, 'Both Password Does not Match', 'Both Password Does not Match', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(521, 1, 'Employee Added Successfully But Email Not Send', 'Employee Added Successfully But Email Not Send', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(522, 1, 'Employee Added Successfully', 'Employee Added Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(523, 1, 'Employee Not Found', 'Employee Not Found', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(524, 1, 'Employee Updated Successfully', 'Employee Updated Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(525, 1, 'Avatar Changed Successfully', 'Avatar Changed Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(526, 1, 'Upload an Image', 'Upload an Image', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(527, 1, 'Bank Account Added Successfully', 'Bank Account Added Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(528, 1, 'Bank Account Already Exist', 'Bank Account Already Exist', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(529, 1, 'Bank Account Deleted Successfully', 'Bank Account Deleted Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(530, 1, 'Bank Account Not Found', 'Bank Account Not Found', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(531, 1, 'This Document Already Exist', 'This Document Already Exist', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(532, 1, 'Document Uploaded Successfully', 'Document Uploaded Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(533, 1, 'Document Deleted Successfully', 'Document Deleted Successfully', '2017-06-14 00:17:17', '2017-06-14 00:17:17'),
(534, 1, 'Document Not Found', 'Document Not Found', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(535, 1, 'Employee Deleted Successfully', 'Employee Deleted Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(536, 1, 'Employee Role added successfully', 'Employee Role added successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(537, 1, 'Employee Role updated successfully', 'Employee Role updated successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(538, 1, 'Employee Role info not found', 'Employee Role info not found', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(539, 1, 'Permission not assigned', 'Permission not assigned', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(540, 1, 'Permission Updated', 'Permission Updated', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(541, 1, 'An Employee contain this role', 'An Employee contain this role', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(542, 1, 'Employee role deleted successfully', 'Employee role deleted successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(543, 1, 'Leave Request Send Successfully', 'Leave Request Send Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(544, 1, 'Expense Added Successfully', 'Expense Added Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(545, 1, 'Support Ticket Created Successfully But Email Not Send', 'Support Ticket Created Successfully But Email Not Send', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(546, 1, 'Support Ticket Created Successfully', 'Support Ticket Created Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(547, 1, 'Basic Info Update Successfully', 'Basic Info Update Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(548, 1, 'Ticket Reply Successfully But Email Not Send', 'Ticket Reply Successfully But Email Not Send', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(549, 1, 'Ticket Reply Successfully', 'Ticket Reply Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(550, 1, 'File Uploaded Successfully', 'File Uploaded Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(551, 1, 'File Deleted Successfully', 'File Deleted Successfully', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(552, 1, 'Ticket File not found', 'Ticket File not found', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(553, 1, 'Please Upload a File', 'Please Upload a File', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(554, 1, 'Payment Details Not found', 'Payment Details Not found', '2017-06-14 00:17:18', '2017-06-14 00:17:18'),
(555, 1, 'Ticket Deleted Successfully', 'Ticket Deleted Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(556, 1, 'There Have no Ticket For Delete', 'There Have no Ticket For Delete', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(557, 1, 'Comment Posted Successfully', 'Comment Posted Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(558, 1, 'Please try again', 'Please try again', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(559, 1, 'Clock In Successfully', 'Clock In Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(560, 1, 'Clock Out Successfully', 'Clock Out Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19');
INSERT INTO `sys_language_data` (`id`, `lan_id`, `lan_data`, `lan_value`, `created_at`, `updated_at`) VALUES
(561, 1, 'Loan Added Successfully', 'Loan Added Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(562, 1, 'Loan information not found', 'Loan information not found', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(563, 1, 'Loan information updated Successfully', 'Loan information updated Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(564, 1, 'Employee training info not found', 'Employee training info not found', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(565, 1, 'Expense Added Successfully', 'Expense Added Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(566, 1, 'Expense Deleted Successfully', 'Expense Deleted Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(567, 1, 'Expense not found', 'Expense not found', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(568, 1, 'Expense Updated Successfully', 'Expense Updated Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(569, 1, 'Holiday Added Successfully', 'Holiday Added Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(570, 1, 'Holiday Already Exist', 'Holiday Already Exist', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(571, 1, 'Holiday Occasion Not Found', 'Holiday Occasion Not Found', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(572, 1, 'Holiday Deleted Successfully', 'Holiday Deleted Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(573, 1, 'Holiday Updated Successfully', 'Holiday Updated Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(574, 1, 'This Job Post Already Exist', 'This Job Post Already Exist', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(575, 1, 'Job Added Successfully', 'Job Added Successfully', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(576, 1, 'Job not found', 'Job not found', '2017-06-14 00:17:19', '2017-06-14 00:17:19'),
(577, 1, 'Job Update Successfully', 'Job Update Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(578, 1, 'Job Deleted Successfully', 'Job Deleted Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(579, 1, 'Applicant Deleted Successfully', 'Applicant Deleted Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(580, 1, 'Applicant not found', 'Applicant not found', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(581, 1, 'Status updated successfully', 'Status updated successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(582, 1, 'Leave added Successfully', 'Leave added Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(583, 1, 'Leave Application not found', 'Leave Application not found', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(584, 1, 'Leave Application Deleted Successfully', 'Leave Application Deleted Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(585, 1, 'Notice Added Successfully', 'Notice Added Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(586, 1, 'Notice Deleted Successfully', 'Notice Deleted Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(587, 1, 'Notice not found', 'Notice not found', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(588, 1, 'Notice Updated Successfully', 'Notice Updated Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(589, 1, 'Salary Updated Successfully', 'Salary Updated Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(590, 1, 'Amount Paid Successfully', 'Amount Paid Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(591, 1, 'Payment Already Paid', 'Payment Already Paid', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(592, 1, 'Payment Details Not found', 'Payment Details Not found', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(593, 1, 'Provident Fund already running', 'Provident Fund already running', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(594, 1, 'Provident Fund Added Successfully', 'Provident Fund Added Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(595, 1, 'Provident Fund information not found', 'Provident Fund information not found', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(596, 1, 'Provident Fund Updated Successfully', 'Provident Fund Updated Successfully', '2017-06-14 00:17:20', '2017-06-14 00:17:20'),
(597, 1, 'Provident Fund paid successfully', 'Provident Fund paid successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(598, 1, 'Provident Fund delete successfully', 'Provident Fund delete successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(599, 1, 'Loan Added Successfully', 'Loan Added Successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(600, 1, 'Loan information not found', 'Loan information not found', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(601, 1, 'Loan information delete Successfully', 'Loan information delete Successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(602, 1, 'User pay transaction data not found', 'User pay transaction data not found', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(603, 1, 'Please check your email setting', 'Please check your email setting', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(604, 1, 'Email send successfully', 'Email send successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(605, 1, 'SMS sent successfully', 'SMS sent successfully', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(606, 1, 'Please check your Twilio Credentials', 'Please check your Twilio Credentials', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(607, 1, 'Success', 'Success', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(608, 1, 'User Validation Failed', 'User Validation Failed', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(609, 1, 'Insufficient Credit', 'Insufficient Credit', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(610, 1, 'Internal Error', 'Internal Error', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(611, 1, 'Invalid receiver', 'Invalid receiver', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(612, 1, 'Invalid SMS', 'Invalid SMS', '2017-06-14 00:17:21', '2017-06-14 00:17:21'),
(613, 1, 'Invalid sender', 'Invalid sender', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(614, 1, 'In progress', 'In progress', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(615, 1, 'Scheduled', 'Scheduled', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(616, 1, 'Authentication failure', 'Authentication failure', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(617, 1, 'Data validation failed', 'Data validation failed', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(618, 1, 'Upstream credits not available', 'Upstream credits not available', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(619, 1, 'You have exceeded your daily quota', 'You have exceeded your daily quota', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(620, 1, 'Upstream quota exceeded', 'Upstream quota exceeded', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(621, 1, 'Temporarily unavailable', 'Temporarily unavailable', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(622, 1, 'Maximum batch size exceeded', 'Maximum batch size exceeded', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(623, 1, 'Failed', 'Failed', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(624, 1, 'Gateway information not found', 'Gateway information not found', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(625, 1, 'Setting Update Successfully', 'Setting Update Successfully', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(626, 1, 'Expense Title Added Successfully', 'Expense Title Added Successfully', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(627, 1, 'Expense Title Already Exist', 'Expense Title Already Exist', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(628, 1, 'Leave Type Added Successfully', 'Leave Type Added Successfully', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(629, 1, 'Leave Type Already Exist', 'Leave Type Already Exist', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(630, 1, 'Award Added Successfully', 'Award Added Successfully', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(631, 1, 'Award Already Exist', 'Award Already Exist', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(632, 1, 'File Extension Update Successfully', 'File Extension Update Successfully', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(633, 1, 'Email Template Not Found', 'Email Template Not Found', '2017-06-14 00:17:22', '2017-06-14 00:17:22'),
(634, 1, 'Email Template Update Successfully', 'Email Template Update Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(635, 1, 'Language Already Exist', 'Language Already Exist', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(636, 1, 'Language Added Successfully', 'Language Added Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(637, 1, 'Language Translate Successfully', 'Language Translate Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(638, 1, 'Language not found', 'Language not found', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(639, 1, 'Language updated Successfully', 'Language updated Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(640, 1, 'Language deleted successfully', 'Language deleted successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(641, 1, 'Expense title deleted successfully', 'Expense title deleted successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(642, 1, 'Expense title not found', 'Expense title not found', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(643, 1, 'Leave type deleted successfully', 'Leave type deleted successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(644, 1, 'Leave type not found', 'Leave type not found', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(645, 1, 'Award name deleted successfully', 'Award name deleted successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(646, 1, 'Award name not found', 'Award name not found', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(647, 1, 'Expense Title Updated Successfully', 'Expense Title Updated Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(648, 1, 'Leave Type Updated Successfully', 'Leave Type Updated Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(649, 1, 'Award Already Exist', 'Award Already Exist', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(650, 1, 'Award Updated Successfully', 'Award Updated Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(651, 1, 'Tax Rules Added Successfully', 'Tax Rules Added Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(652, 1, 'Tax Rules Already Exist', 'Tax Rules Already Exist', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(653, 1, 'Tax Rules Updated Successfully', 'Tax Rules Updated Successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(654, 1, 'Tax Rule deleted successfully', 'Tax Rule deleted successfully', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(655, 1, 'Tax Rule not found', 'Tax Rule not found', '2017-06-14 00:17:23', '2017-06-14 00:17:23'),
(656, 1, 'Another Gateway already active', 'Another Gateway already active', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(657, 1, 'Gateway updated successfully', 'Gateway updated successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(658, 1, 'Menu not found', 'Menu not found', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(659, 1, 'Information updated successfully', 'Information updated successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(660, 1, 'Department Name Already exist, Please use different name', 'Department Name Already exist, Please use different name', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(661, 1, 'Email Address Already exist, Please use different email address', 'Email Address Already exist, Please use different email address', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(662, 1, 'Employee not assigned', 'Employee not assigned', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(663, 1, 'Task Created Successfully', 'Task Created Successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(664, 1, 'Task not found', 'Task not found', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(665, 1, 'Task Updated Successfully', 'Task Updated Successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(666, 1, 'Task File not found', 'Task File not found', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(667, 1, 'Task Deleted Successfully', 'Task Deleted Successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(668, 1, 'Trainer added successfully', 'Trainer added successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(669, 1, 'Trainer deleted successfully', 'Trainer deleted successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(670, 1, 'Trainer info not found', 'Trainer info not found', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(671, 1, 'Trainer updated successfully', 'Trainer updated successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(672, 1, 'Training added successfully', 'Training added successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(673, 1, 'Employee training deleted successfully', 'Employee training deleted successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(674, 1, 'Training info updated successfully', 'Training info updated successfully', '2017-06-14 00:17:24', '2017-06-14 00:17:24'),
(675, 1, 'Training needs assessment added successfully', 'Training needs assessment added successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(676, 1, 'Training needs assessment deleted successfully', 'Training needs assessment deleted successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(677, 1, 'Training needs assessment info not found', 'Training needs assessment info not found', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(678, 1, 'Training needs assessment updated successfully', 'Training needs assessment updated successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(679, 1, 'Trainer not assigned', 'Trainer not assigned', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(680, 1, 'Training event added successfully', 'Training event added successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(681, 1, 'Training event deleted successfully', 'Training event deleted successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(682, 1, 'Training event info not found', 'Training event info not found', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(683, 1, 'Training event updated successfully', 'Training event updated successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(684, 1, 'Training evaluation completed', 'Training evaluation completed', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(685, 1, 'Training evaluation updated', 'Training evaluation updated', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(686, 1, 'Training evaluation info not found', 'Training evaluation info not found', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(687, 1, 'Training evaluation deleted successfully', 'Training evaluation deleted successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(688, 1, 'Invalid User Name or Password', 'Invalid User Name or Password', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(689, 1, 'Invalid Access', 'Invalid Access', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(690, 1, 'Logout Successfully', 'Logout Successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(691, 1, 'Profile Updated Successfully', 'Profile Updated Successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(692, 1, 'Password Change Successfully', 'Password Change Successfully', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(693, 1, 'Both New Password Does Not Match', 'Both New Password Does Not Match', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(694, 1, 'Current Password Does Not Match', 'Current Password Does Not Match', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(695, 1, 'Password Reset Successfully. Please check your email', 'Password Reset Successfully. Please check your email', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(696, 1, 'Your Password Already Reset. Please Check your email', 'Your Password Already Reset. Please Check your email', '2017-06-14 00:17:25', '2017-06-14 00:17:25'),
(697, 1, 'Sorry There is no registered user with this email address', 'Sorry There is no registered user with this email address', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(698, 1, 'A New Password Generated. Please Check your email.', 'A New Password Generated. Please Check your email.', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(699, 1, 'Sorry Password reset Token expired or not exist, Please try again.', 'Sorry Password reset Token expired or not exist, Please try again.', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(700, 1, 'Job Details Not found', 'Job Details Not found', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(701, 1, 'Please upload your resume', 'Please upload your resume', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(702, 1, 'Resume Submitted Successfully', 'Resume Submitted Successfully', '2017-06-14 00:17:26', '2017-06-14 00:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `sys_leave`
--

CREATE TABLE `sys_leave` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_from` date NOT NULL,
  `leave_to` date NOT NULL,
  `ltype_id` int(11) NOT NULL,
  `applied_on` date NOT NULL,
  `leave_reason` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('approved','pending','rejected') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `remark` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_leave_type`
--

CREATE TABLE `sys_leave_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `leave` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `leave_quota` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_loan`
--

CREATE TABLE `sys_loan` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `loan_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `enable_payslip` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `repayment_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `remaining_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `repayment_start_date` date NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` enum('ongoing','completed','rejected','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_notice`
--

CREATE TABLE `sys_notice` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Published','Unpublished') COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_payroll`
--

CREATE TABLE `sys_payroll` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `department` int(11) NOT NULL,
  `designation` int(11) NOT NULL,
  `payment_month` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` date NOT NULL DEFAULT '2017-06-14',
  `net_salary` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tax` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `provident_fund` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `loan` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `overtime_salary` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_salary` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` enum('Cash Payment','Bank Payment','Cheque Payment') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_provident_fund`
--

CREATE TABLE `sys_provident_fund` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) NOT NULL,
  `provident_fund_type` enum('Fixed Amount','Percentage of Basic Salary') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Percentage of Basic Salary',
  `employee_share` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `organization_share` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `payment_type` enum('Cash Payment','Bank Payment','Cheque Payment') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Paid','Unpaid') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_sms_gateways`
--

CREATE TABLE `sys_sms_gateways` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `api_link` text COLLATE utf8_unicode_ci,
  `user_name` text COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `api_id` text COLLATE utf8_unicode_ci,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_sms_gateways`
--

INSERT INTO `sys_sms_gateways` (`id`, `name`, `api_link`, `user_name`, `password`, `api_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Twilio', '', 'User id', 'Auth Token', '', 'Inactive', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(2, 'Route SMS', 'http://smsplus1.routesms.com:8080/bulksms/bulksms', 'User Name', 'Password', '', 'Active', '2017-06-14 00:17:26', '2017-06-14 00:17:26'),
(3, 'Bulk SMS', 'http://bulksms.2way.co.za', 'User Name', 'Password', '', 'Inactive', '2017-06-14 00:17:26', '2017-06-14 00:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `sys_support_departments`
--

CREATE TABLE `sys_support_departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `show` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_task`
--

CREATE TABLE `sys_task` (
  `id` int(10) UNSIGNED NOT NULL,
  `task` text COLLATE utf8_unicode_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `estimated_hour` int(11) DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `progress` int(11) NOT NULL DEFAULT '0',
  `status` enum('pending','started','completed') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_task_comments`
--

CREATE TABLE `sys_task_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_task_employee`
--

CREATE TABLE `sys_task_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_task_files`
--

CREATE TABLE `sys_task_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `file_title` text COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_tax_rules`
--

CREATE TABLE `sys_tax_rules` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_name` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_tax_rules`
--

INSERT INTO `sys_tax_rules` (`id`, `tax_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tax Rule 1', 'active', '2017-06-14 00:17:27', '2017-06-14 00:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_tax_rules_details`
--

CREATE TABLE `sys_tax_rules_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `tax_id` int(11) NOT NULL,
  `salary_from` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `salary_to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tax_percentage` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `additional_tax_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `gender` enum('Both','Male','Female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Both',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sys_tax_rules_details`
--

INSERT INTO `sys_tax_rules_details` (`id`, `tax_id`, `salary_from`, `salary_to`, `tax_percentage`, `additional_tax_amount`, `gender`, `created_at`, `updated_at`) VALUES
(1, 1, '0', '20000', '0', '0', 'Both', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(2, 1, '20001', '30000', '1', '0', 'Both', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(3, 1, '30001', '40000', '2', '0', 'Both', '2017-06-14 00:17:27', '2017-06-14 00:17:27'),
(4, 1, '40001', '50000', '3', '0', 'Both', '2017-06-14 00:17:27', '2017-06-14 00:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `sys_tickets`
--

CREATE TABLE `sys_tickets` (
  `id` int(10) UNSIGNED NOT NULL,
  `did` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Answered','Customer Reply','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `admin` text COLLATE utf8_unicode_ci NOT NULL,
  `replyby` text COLLATE utf8_unicode_ci,
  `closed_by` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_ticket_files`
--

CREATE TABLE `sys_ticket_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `file_title` text COLLATE utf8_unicode_ci NOT NULL,
  `file_size` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `file` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_ticket_replies`
--

CREATE TABLE `sys_ticket_replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `tid` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `admin` text COLLATE utf8_unicode_ci,
  `image` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_trainers`
--

CREATE TABLE `sys_trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `designation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `organization` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `expertise` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_evaluations`
--

CREATE TABLE `sys_training_evaluations` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_events`
--

CREATE TABLE `sys_training_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `sponsored_by` text COLLATE utf8_unicode_ci,
  `organized_by` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `status` enum('upcoming','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'upcoming',
  `externals` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_events_employee`
--

CREATE TABLE `sys_training_events_employee` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_events_trainers`
--

CREATE TABLE `sys_training_events_trainers` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_members`
--

CREATE TABLE `sys_training_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_needs_assessment`
--

CREATE TABLE `sys_training_needs_assessment` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` int(11) NOT NULL,
  `training_type` enum('Online Training','Seminar','Lecture','Workshop','Hands On Training','Webinar') COLLATE utf8_unicode_ci NOT NULL,
  `training_subject` enum('HR Training','Employees Development','IT Training','Finance Training','Others') COLLATE utf8_unicode_ci NOT NULL,
  `training_nature` enum('Internal','External') COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `training_reason` text COLLATE utf8_unicode_ci,
  `trainer` int(11) DEFAULT NULL,
  `training_location` text COLLATE utf8_unicode_ci,
  `training_from` date NOT NULL,
  `training_to` date NOT NULL,
  `training_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `travel_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','approved','rejected','completed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sys_training_needs_assessment_members`
--

CREATE TABLE `sys_training_needs_assessment_members` (
  `id` int(10) UNSIGNED NOT NULL,
  `training_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sys_appconfig`
--
ALTER TABLE `sys_appconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_attendance`
--
ALTER TABLE `sys_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_award`
--
ALTER TABLE `sys_award`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_award_list`
--
ALTER TABLE `sys_award_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_department`
--
ALTER TABLE `sys_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_designation`
--
ALTER TABLE `sys_designation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_disable_menu`
--
ALTER TABLE `sys_disable_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_email_templates`
--
ALTER TABLE `sys_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee`
--
ALTER TABLE `sys_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee_bank_accounts`
--
ALTER TABLE `sys_employee_bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee_files`
--
ALTER TABLE `sys_employee_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee_roles`
--
ALTER TABLE `sys_employee_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee_roles_permission`
--
ALTER TABLE `sys_employee_roles_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_employee_training`
--
ALTER TABLE `sys_employee_training`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_expense`
--
ALTER TABLE `sys_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_expense_title`
--
ALTER TABLE `sys_expense_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_holiday`
--
ALTER TABLE `sys_holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_jobs`
--
ALTER TABLE `sys_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_job_applicants`
--
ALTER TABLE `sys_job_applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_language`
--
ALTER TABLE `sys_language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_language_data`
--
ALTER TABLE `sys_language_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_leave`
--
ALTER TABLE `sys_leave`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_leave_type`
--
ALTER TABLE `sys_leave_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_loan`
--
ALTER TABLE `sys_loan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_notice`
--
ALTER TABLE `sys_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_payroll`
--
ALTER TABLE `sys_payroll`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_provident_fund`
--
ALTER TABLE `sys_provident_fund`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_sms_gateways`
--
ALTER TABLE `sys_sms_gateways`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_support_departments`
--
ALTER TABLE `sys_support_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_task`
--
ALTER TABLE `sys_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_task_comments`
--
ALTER TABLE `sys_task_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_task_employee`
--
ALTER TABLE `sys_task_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_task_files`
--
ALTER TABLE `sys_task_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_tax_rules`
--
ALTER TABLE `sys_tax_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_tax_rules_details`
--
ALTER TABLE `sys_tax_rules_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_tickets`
--
ALTER TABLE `sys_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_ticket_files`
--
ALTER TABLE `sys_ticket_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_ticket_replies`
--
ALTER TABLE `sys_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_trainers`
--
ALTER TABLE `sys_trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_evaluations`
--
ALTER TABLE `sys_training_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_events`
--
ALTER TABLE `sys_training_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_events_employee`
--
ALTER TABLE `sys_training_events_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_events_trainers`
--
ALTER TABLE `sys_training_events_trainers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_members`
--
ALTER TABLE `sys_training_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_needs_assessment`
--
ALTER TABLE `sys_training_needs_assessment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sys_training_needs_assessment_members`
--
ALTER TABLE `sys_training_needs_assessment_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sys_appconfig`
--
ALTER TABLE `sys_appconfig`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sys_attendance`
--
ALTER TABLE `sys_attendance`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_award`
--
ALTER TABLE `sys_award`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_award_list`
--
ALTER TABLE `sys_award_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_department`
--
ALTER TABLE `sys_department`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_designation`
--
ALTER TABLE `sys_designation`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_disable_menu`
--
ALTER TABLE `sys_disable_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sys_email_templates`
--
ALTER TABLE `sys_email_templates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sys_employee`
--
ALTER TABLE `sys_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sys_employee_bank_accounts`
--
ALTER TABLE `sys_employee_bank_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_employee_files`
--
ALTER TABLE `sys_employee_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_employee_roles`
--
ALTER TABLE `sys_employee_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_employee_roles_permission`
--
ALTER TABLE `sys_employee_roles_permission`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_employee_training`
--
ALTER TABLE `sys_employee_training`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_expense`
--
ALTER TABLE `sys_expense`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_expense_title`
--
ALTER TABLE `sys_expense_title`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_holiday`
--
ALTER TABLE `sys_holiday`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_jobs`
--
ALTER TABLE `sys_jobs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_job_applicants`
--
ALTER TABLE `sys_job_applicants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_language`
--
ALTER TABLE `sys_language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sys_language_data`
--
ALTER TABLE `sys_language_data`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=703;
--
-- AUTO_INCREMENT for table `sys_leave`
--
ALTER TABLE `sys_leave`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_leave_type`
--
ALTER TABLE `sys_leave_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_loan`
--
ALTER TABLE `sys_loan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_notice`
--
ALTER TABLE `sys_notice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_payroll`
--
ALTER TABLE `sys_payroll`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_provident_fund`
--
ALTER TABLE `sys_provident_fund`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_sms_gateways`
--
ALTER TABLE `sys_sms_gateways`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sys_support_departments`
--
ALTER TABLE `sys_support_departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_task`
--
ALTER TABLE `sys_task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_task_comments`
--
ALTER TABLE `sys_task_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_task_employee`
--
ALTER TABLE `sys_task_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_task_files`
--
ALTER TABLE `sys_task_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_tax_rules`
--
ALTER TABLE `sys_tax_rules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sys_tax_rules_details`
--
ALTER TABLE `sys_tax_rules_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sys_tickets`
--
ALTER TABLE `sys_tickets`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_ticket_files`
--
ALTER TABLE `sys_ticket_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_ticket_replies`
--
ALTER TABLE `sys_ticket_replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_trainers`
--
ALTER TABLE `sys_trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_evaluations`
--
ALTER TABLE `sys_training_evaluations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_events`
--
ALTER TABLE `sys_training_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_events_employee`
--
ALTER TABLE `sys_training_events_employee`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_events_trainers`
--
ALTER TABLE `sys_training_events_trainers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_members`
--
ALTER TABLE `sys_training_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_needs_assessment`
--
ALTER TABLE `sys_training_needs_assessment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sys_training_needs_assessment_members`
--
ALTER TABLE `sys_training_needs_assessment_members`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
