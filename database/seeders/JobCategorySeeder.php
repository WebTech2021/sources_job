<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $job_category = array(
            array('id' => '1','name' => 'Accounting Finance','slug'=>'accounting_finance'),
            array('id' => '2','name' => 'Bank/Non-Bank Fin. Institution','slug'=>'bank_Non_Bank'),
            array('id' => '3','name' => 'Commercial/Supply Chain','slug'=>'commercial_supply'),
            array('id' => '4','name' => 'Education/Training','slug'=>'education_training'),
            array('id' => '5','name' => 'Engineer/Architect','slug'=>'engineer_architect'),
            array('id' => '6','name' => 'Garments/Textile','slug'=>'garments_textile'),
            array('id' => '7','name' => 'General Management/Admin','slug'=>'general_management_admin'),
            array('id' => '8','name' => 'IT/Telecommunication','slug'=>'it_telecommunication'),
            array('id' => '9','name' => 'Marketing/Sales','slug'=>'marketing_sales'),
            array('id' => '10','name' => 'Media/Advertisement/Event Mgt.','slug'=>'media_advertisement_event'),
            array('id' => '11','name' => 'Medical/Pharma','slug'=>'medical_pharma'),
            array('id' => '12','name' => 'NGO/Development','slug'=>'NGO_dev'),
            array('id' => '13','name' => 'Research/Consultancy','slug'=>'research_consultancy'),
            array('id' => '14','name' => 'Secretary/Receptionist','slug'=>'secretary_receptionist'),
            array('id' => '15','name' => 'Data Entry/Operator/BPO','slug'=>'data_entry'),
            array('id' => '16','name' => 'Customer Support/Call Centre','slug'=>'customer_support'),
            array('id' => '17','name' => 'HR/Org','slug'=>'HR_org_development'),
            array('id' => '18','name' => 'Design/Creative','slug'=>'design_creative'),
            array('id' => '19','name' => 'Production/Operation','slug'=>'production_operation'),
            array('id' => '20','name' => 'Hospitality/ Travel/ Tourism','slug'=>'hospitality_travel_tourism'),
            array('id' => '21','name' => 'Beauty Care/ Health & Fitness','slug'=>'beauty_care_health'),
            array('id' => '22','name' => 'Law/Legal','slug'=>'law_legal'),
            array('id' => '23','name' => 'Electrician/ Construction/ Repair','slug'=>'electrician_construction'),
            array('id' => '24','name' => 'Security/Support Service','slug'=>'security_support_service'),
            array('id' => '25','name' => 'Driving/Motor Technician','slug'=>'driving_motor_technician'),
            array('id' => '26','name' => 'Agro (Plant/Animal/Fisheries)','slug'=>'agro'),
        );
        DB::table('job_categories')->insert($job_category);
    }
}
