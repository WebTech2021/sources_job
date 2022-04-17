<?php

namespace App\Exports;


use App\Models\JobSeeker\JobSeeker;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;

class JobSeekerExport implements FromCollection, WithCustomCsvSettings, WithHeadings
{
    use Exportable;
    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ';'
        ];
    }
    public function headings(): array
    {
        return ["ID","First Name","Last Name","NID", "Date of Birth","Father Name","Mother Name","Phone Number","Email","Gender","Address","Created at","Updated at"];
    }
    public function collection()
    {
        return JobSeeker::select('id','first_name','last_name','nid','dob','father_name','mother_name','phone_number','email','gender','p_address','created_at','updated_at')->get();
    }
}


