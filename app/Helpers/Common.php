<?php

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\MasterSetting;
use App\Models\Country;

use App\Models\Notification;
use App\Models\NotificationTemplate;

if (!function_exists('sendNotification')) {
    /**
     * Send notification using a template key.
     *
     * @param string $key  Template key (e.g., listing_published, wallet_credit)
     * @param array  $data Placeholder data to replace in subject/content
     * @param mixed  $customers Single customer_id, array of customer_ids, or null (for broadcast)
     */
    function sendNotification(string $key, array $data = [], $customers = null)
    {
        // 1. Get template
        $template = NotificationTemplate::where('key', $key)
            ->where('is_active', true)
            ->first();

        if (!$template) {
            return false; // no template found
        }

        // 2. Replace placeholders in subject and content
        $subject = $template->subject;
        $content = $template->content;

        foreach ($data as $placeholder => $value) {
            $subject = str_replace("{" . $placeholder . "}", $value, $subject);
            $content = str_replace("{" . $placeholder . "}", $value, $content);
        }

        // 3. Create notification record
        $notification = Notification::create([
            'template_id'   => $template->id,
            'subject'       => $subject,
            'content'       => $content,
            'channels'      => $template->channels,
            'is_broadcast'  => $template->default_recipient === 'all_customers',
            'broadcast_filter' => null, // optional filter rules
        ]);

        // 4. Attach customers
        if ($template->default_recipient === 'all_customers') {
            // broadcast → attach all customers
            $allCustomers = \App\Models\Customer::pluck('id')->toArray();
            $notification->customers()->attach($allCustomers);
        } else {
            // specific customers
            if ($customers) {
                if (!is_array($customers)) {
                    $customers = [$customers];
                }
                $notification->customers()->attach($customers);
            }
        }

        return $notification;
    }
}


if (!function_exists('ageInYear')) {
	function ageInYear($dob) 
	{
		return \Carbon\Carbon::parse($dob)->diff(\Carbon\Carbon::now())->format('%y');
		// format('%y years, %m months and %d days');
	}
}

if (!function_exists('dateWithoutTime')) {
	function dateWithoutTime($dob) 
	{
		return \Carbon\Carbon::parse($dob)->format('Y-m-d');
	}
}

if (!function_exists('dateWithMonth')) {
	function dateWithMonth($dob) 
	{
		return \Carbon\Carbon::parse($dob)->format('d-M-Y');
	}
}

if (!function_exists('_replace')) {
	function _replace($value) 
	{
		return str_replace("_"," ", $value);
	}
}

if (!function_exists('ar2str')) {
	function ar2str($value) 
	{
		if(is_array($value)){
			return implode(',', $value);

		}
		return $value;
	}
}

if (!function_exists('str2ar')) {
	function str2ar($value) 
	{
		$arr = [];
		$data = explode(',', $value);
		return array_merge($arr, $data);
	}
}

if (!function_exists('_allMasterSettings')) {
	function _allMasterSettings(){
		return MasterSetting::whereNotIn('id', [3,4,5])->where('is_enable', '1')->get();
	}
	
}

if (!function_exists('_getParentCategoryName')) {
	function _getParentCategoryName($category_id){
		$category = Category::where('id', $category_id)->first('category_name');
		return $category->category_name;
	}
	
}

if (!function_exists('_subCategory')) {
	function _subCategory($category_id){
		$category = Category::where('id', $category_id)->first('category_name');
		return $category->category_name;
	}
	
}

if (!function_exists('menuCategories')) {
	function menuCategories(){
		$categories = Category::with('subcategories')->where('status', 'active')->get();
		
		return $categories;
	}
	
}
if (!function_exists('footerSubCategories')) {
	function footerSubCategories(){
		$subcategories = Subcategory::where('status', 'active')->where('is_premium', 'yes')->get();
		return $subcategories;
	}
	
}
if (!function_exists('countrylist')) {
	function countrylist(){
		$countries = Country::get();
		return $countries;
	}
	
}

?>