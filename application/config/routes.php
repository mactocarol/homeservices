<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'front/home/index';
$route['404_override'] = '';
/***********************ADMIN*************************************************/

$route['logout'] = 'admin/logout';
$route['dashboard'] = 'admin/dashboard';
$route['profile'] = 'admin/profile';
$route['changeprofile']="admin/edit_profile";
$route['AddPage']="pages/add_page";
$route['AddPagePost']="pages/add_page_post";
$route['EditPageDetails/(:any)']="pages/edit_page_detail/$1";
$route['DeletePage/(:any)']="pages/delete/$1";
$route['EditPagePost/(:any)']="pages/edit_page_post/$1";
$route['ManagePages']="pages/index";
$route['ManageUser']="user/index";
$route['EditUser/(:any)']="user/edit_user";
$route['DeleteUser/(:any)']="user/delete_user";
$route['ManageBanner']="banner/index";
$route['EditBanner/(:any)'] = "banner/edit_banner";
$route['AddBanner'] = "banner/add_banner";
$route['DeleteBanner/(:any)'] = "banner/delete_banner";
$route['ManageCategories'] = "categories/index";
$route['AddCategories'] = "categories/add_category";
$route['EditCategories/(:any)'] = "categories/edit_cat";
$route['DeleteCategories/(:any)'] = "categories/delete_cat";
$route['ManageTemplate'] = "template/index";
$route['AddTemplate'] = "template/add";
$route['EditTemplateDetails/(:any)'] = "Template/edit";
$route['DeleteTemplate/(:any)'] = "template/delete";
$route['ManageBlog'] = "blog/index";
$route['AddBlog'] = "blog/add_blog";
$route['EditBlogDetails/(:any)'] = "blog/edit_blog";
$route['DeleteBlog/(:any)'] = "blog/delete_blog";
$route['ManageVendor'] = "vendor/index";
$route['AddVendor'] = "vendor/add_vendor";
$route['EditVendorDetails/(:any)'] = "vendor/edit_vendor";
$route['DeleteVendor/(:any)'] = "vendor/delete_vendor";
$route['ManageReview'] = "review/index";
$route['AddReview'] = "review/add_review";
$route['EditReviewDetails/(:any)'] = "review/edit_review";
$route['DeleteReview/(:any)'] = "review/delete_review";
$route['ManageTestimonial'] = "testimonial/index";
$route['AddTestimonial'] = "testimonial/add_testimonial";
$route['EditTestimonialDetails/(:any)'] = "testimonial/edit_testimonial";
$route['DeleteTestmonial/(:any)'] = "testimonial/delete_testimonial";
$route['ManagePromocode'] = "promocode/index";
$route['AddPromocode'] = "promocode/add_promocode";
$route['EditPromocodeDetails/(:any)'] = "promocode/edit_promocode";
$route['DeletePromocode/(:any)'] = "promocode/delete_promocode";
$route['CheckPrice/(:any)/(:any)/(:any)'] = "front/service/check_price/$1/$2/$3";
$route['CheckPrice1/(:any)/(:any)/(:any)'] = "front/service/check_price1/$1/$2/$3";
$route['Booking'] = "front/service/booking";

$route['finalize/(:any)'] = "front/service/finalize/$1";

$route['BookingTerms'] = "front/service/booking_terms";
$route['BookingPlan/(:any)/(:any)'] = "front/service/booking_plan/$1/$2";
$route['GeneralBooking/(:any)'] = "front/service/general_booking/$1";
$route['BookingPlan_mnth/(:any)/(:any)/(:any)'] = "front/service/book_plan_mnth/$1/$2/$3";
$route['ManageLocation'] = "location/index";
$route['AddLocation'] = "location/add_location";
$route['EditLocation/(:any)'] = "location/edit_location";
$route['DeleteLocation/(:any)'] = "location/delete_location";
$route['ImportCSV'] = "location/import_zipcode";

$route['ManagePlan'] = "plan/index";
$route['AddPlan'] = "plan/add_plan";
$route['EditPlan/(:any)'] = "plan/edit_plan";
$route['DeletePlan/(:any)'] = "plan/delete_plan";
$route['Getsubcat/(:any)'] = "plan/getsubcat";
$route['ManageBooking'] = "Booking/index";
$route['BookingDelete'] = "Booking/booking_delete";
$route['get_category_price'] = "front/service/Get_a_price";
$route['ManageRealState'] = "Real_state/real";
$route['DeleteInfo/(:any)'] = "Real_state/delete_realstate";

$route['ManageImprovement'] = "Home_improvement/index";
$route['DeleteImprovement/(:any)'] = "Home_improvement/delete_improvement";

$route['payment/(:any)'] = "front/service/payment/$1";



//$route['translate_uri_dashes'] = FALSE;
/*************************FRONT*************************************************/
$route['Home'] = "front/home/index";
$route['AboutUs'] =  "front/home/about_us";
$route['Blog'] =  "front/Blog/index";
$route['BlogDetails/(:any)'] =  "front/Blog/blog_details/$1";
$route['Contact-us'] =  "front/contact/index";
$route['Serching'] =  "front/home/search";
$route['Term-Condition'] =  "front/home/terms";
$route['Privacy-Policy'] = "front/home/privacy_policy";
$route['Cancellation_policy'] = "front/home/cancellation_policy";
$route['Press'] = "front/home/press";
/*************************FRONT Login*************************************************/
$route['Login'] = "front/login/index";
$route['Logout'] = "front/login/logout";
$route['Signup'] = "front/login/sign_up";
$route['active-account/(:any)'] = 'front/login/active_account/$1';
$route['Forgot-password'] = 'front/login/forgot_password';
/*********************** Dashboard**************/
$route['My-account'] = 'front/myaccount';
$route['My-address'] = 'front/myaccount/my_address';
$route['changepassword'] = 'front/myaccount/changePassword';
$route['Feedback'] = 'front/myaccount/feedback';
$route['Vendors'] = 'front/Vendors/vendors_info';
$route['VendorsRegisterHere/(:any)'] = 'front/Vendors/vendors_fill_details/$1';
$route['Services/(:any)']  = "front/service/index/$1";
$route['RealState/(:any)']  = "front/service/real_state/$1";
$route['Services/(:any)/(:any)']  = "front/service/index/$1/$2";
$route['Services/(:any)/(:any)']  = "front/service/single_service/$1/$2";
$route['GetPrice/(:any)/(:any)']  = "front/service/unit_price/$1/$2";
$route['Minus_GetPrice/(:any)/(:any)']  = "front/service/unit_price/$1/$2";
$route['l_GetPrice/(:any)/(:any)/(:any)']  = "front/service/unit_price/$1/$2/$3";
$route['l_minus_GetPrice/(:any)/(:any)/(:any)']  = "front/service/unit_price/$1/$2/$3";
$route['m_GetPrice/(:any)/(:any)/(:any)/(:any)']  = "front/service/unit_price/$1/$2/$3/$4";
$route['m_minus_GetPrice/(:any)/(:any)/(:any)/(:any)']  = "front/service/unit_price/$1/$2/$3/$4";
$route['GetPrice12/(:any)'] = "front/service/check_price1/$1";
$route['GetPrice_new/(:any)']  = "front/service/unit_price_new/$1";
$route['Improvment/(:any)']  = "front/service/home_improvement/$1";
// for plan....
$route['BadroomPlan/(:any)/(:any)/(:any)/(:any)']  = "front/service/badroom_plan/$1/$2/$3/$4";
$route['plan_weekly_biweekly/(:any)/(:any)']  = "front/service/plan_weekedwise/$1/$2";
$route['Plan/(:any)/(:any)']  = "front/service/without_plan/$1/$2";
$route['Plan1/(:any)/(:any)']  = "front/service/without_plan1/$1/$2";

$route['Quotes/(:any)/(:any)']  = "front/service/pressure_washing/$1/$2";

$route['Quote/(:any)/(:any)']  = "front/service/sofa_cleaning/$1/$2";

$route['Final/(:any)/(:any)']  = "front/service/helping_hand/$1/$2";

$route['Finals/(:any)/(:any)']  = "front/service/appliance_fixing/$1/$2";

$route['Final-Movers/(:any)/(:any)']  = "front/service/movers/$1/$2";
