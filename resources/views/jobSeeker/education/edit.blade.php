@extends('layouts.job_seeker')
@section('page-title','JobSeeker Education update')
@section('breadcrumb')
    <h2 class="content-header-title float-left mb-0">{{__('Update Education')}}</h2>
    <div class="breadcrumb-wrapper">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('jobSeeker.home') }}">{{__('Home')}}</a></li>
            <li class="breadcrumb-item active">{{__('Education Update')}}</li>
        </ol>
    </div>
@endsection

@section('content')
    <section id="basic-datatable">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom p-1">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Update Education')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('jobSeeker.education.index')}}" class="dt-button create-new btn btn-primary ml-1 mr-1" tabindex="0"
                                   aria-controls="DataTables_Table_0" type="button">
                                    <span><i class="fas fa-backspace"></i> {{__('Back')}} </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{route('jobSeeker.education.update',encrypt($education->id))}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row mt-2">
                                <div class="form-group col-sm-4">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Level of Education:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_level" id="education_level" required="">
                                            <option value="" disabled selected>Select one</option>
                                            <option value="psc"  {{old('education_level',$education->education_level) == 'psc' ? 'selected': ''}}>PSC/5 pass</option>
                                            <option value="jsc" {{old('education_level',$education->education_level) == 'jsc' ? 'selected': ''}}>JSC/JDC/8 pass</option>
                                            <option value="secondary" {{old('education_level',$education->education_level) == 'secondary' ? 'selected': ''}} >Secondary</option>
                                            <option value="higher_secondary" {{old('education_level',$education->education_level) == 'higher_secondary' ? 'selected': ''}}>Higher Secondary</option>
                                            <option value="diploma" {{old('education_level',$education->education_level) == 'diploma' ? 'selected': ''}}>Diploma</option>
                                            <option value="bachelor_honors" {{old('education_level',$education->education_level) == 'bachelor_honors' ? 'selected': ''}}>Bachelor/Honors</option>
                                            <option value="masters" {{old('education_level',$education->education_level) == 'masters' ? 'selected': ''}}>Masters</option>
                                            <option value="phd" {{old('education_level',$education->education_level) == 'phd' ? 'selected': ''}}>PhD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" id="d1_title">
                                    <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>
                                    <select class="form-control select2  aria-disabled" name="degree_title" id="degree_title">

                                    </select>
                                </div>

                                <div class="form-group col-sm-4" id="d2_title">
                                    <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="Exam Type/Degree Title" name="phd_title" type="text" value="{{old('phd_title',$education->phd_title)}}" required>
                                </div>

                                <div class="form-group col-sm-4" id="education_board">
                                    <div class="position-relative" data-select2-id="64">
                                        <label for="degree_title">Board:</label><span class="text-danger">*</span>
                                        <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_board">
                                            <option value="" disabled selected>Select one</option>
                                            <option value="Barishal"  {{old('education_level',$education->education_board) == 'Barishal' ? 'selected': ''}}>Barishal</option>
                                            <option value="Chattogram"{{old('education_level',$education->education_board) == 'Chattogram' ? 'selected': ''}} >Chattogram</option>
                                            <option value="Comilla" {{old('education_level',$education->education_board) == 'Comilla' ? 'selected': ''}}>Cumilla</option>
                                            <option value="Dhaka" {{old('education_level',$education->education_board) == 'Dhaka' ? 'selected': ''}}>Dhaka</option>
                                            <option value="Dinajpur" {{old('education_level',$education->education_board) == 'Dinajpur' ? 'selected': ''}}>Dinajpur</option>
                                            <option value="Jashore" {{old('education_level',$education->education_board) == 'Jashore' ? 'selected': ''}}>Jashore</option>
                                            <option value="Mymensingh" {{old('education_level',$education->education_board) == 'Mymensingh' ? 'selected': ''}}>Mymensingh</option>
                                            <option value="Rajshahi" {{old('education_level',$education->education_board) == 'Rajshahi' ? 'selected': ''}}>Rajshahi</option>
                                            <option value="Sylhet" {{old('education_level',$education->education_board) == 'Sylhet' ? 'selected': ''}}>Sylhet</option>
                                            <option value="Madrasah" {{old('education_level',$education->education_board) == 'Madrasah' ? 'selected': ''}}>Madrasah</option>
                                            <option value="Technical" {{old('education_level',$education->education_board) == 'Technical' ? 'selected': ''}}>Technical</option>
                                            <option value="BOU" {{old('education_level',$education->education_board) == 'BOU' ? 'selected': ''}}>BOU(Bangladesh Open University)</option>
                                            <option value="Foreign_Institute" {{old('education_level',$education->education_board) == 'Foreign_Institute' ? 'selected': ''}}>Foreign Institute</option>
                                            <option value="Other" {{old('education_level',$education->education_board) == 'Other' ? 'selected': ''}}>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4" id="group">
                                    <label for="country">Concentration/Major/Group:</label><span class="text-danger">*</span>
                                    <input class="form-control"  name="group" type="text" id="group"  placeholder="Concentration/Major/Group" value="{{old('group',$education->group)}}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="institute">Institute Name:</label><span class="text-danger">*</span>
                                    <input class="form-control" required="" placeholder="Institute Name" name="institute_name" type="text" id="institute_name" value="{{old('institute_name',$education->institute_name)}}">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="result">Result:</label><span class="text-danger">*</span>
                                    <select class="form-control select2" name="result" type="text" id="result">
                                        <option value="" disabled selected>Select</option>
                                        <option value="1st_class" {{old('result',$education->result) == '1st_class' ? 'selected': ''}}>First Division/Class</option>
                                        <option value="2nd_class" {{old('result',$education->result) == '2nd_class' ? 'selected': ''}}>Second Division/Class</option>
                                        <option value="3rd_class" {{old('result',$education->result) == '3rd_class' ? 'selected': ''}}>Third Division/Class</option>
                                        <option value="grade" {{old('result',$education->result) == 'grade' ? 'selected': ''}}>Grade</option>
                                    </select>
                                    {{--                                    <input class="form-control" required="" name="result" type="number" id="result" value="{{old('result')}}">--}}
                                </div>
                                <div class="form-group col-sm-4" id="mark">
                                    <label for="institute">Marks  <b>(%)</b></label><span class="text-danger">*</span>
                                    <input class="form-control"  name="mark" type="number"  value="{{old('mark',$education->mark)}}">
                                </div>
                                <div class="form-group col-sm-4" id="cgpa">
                                    <label for="institute">CGPA </label><span class="text-danger">*</span>
                                    <input class="form-control" placeholder="cgpa" name="cgpa" type="text"  value="{{old('cgpa',$education->cgpa)}}">
                                </div>
                                <div class="form-group col-sm-4" id="scale">
                                    <label for="institute">Scale </label><span class="text-danger">*</span>
                                    <input class="form-control"  placeholder="scale" name="scale" type="number"  value="{{old('scale',$education->scale)}}">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="year">Passing Year:</label><span class="text-danger">*</span>
                                    <select class="form-control" id="" name="passing_year">
                                        {{ $last= date('Y')-121 }}
                                        {{ $now = date('Y') }}
                                        @for ($i = $now; $i >= $last; $i--)
                                            <option value="{{ $i }}"  {{$education->passing_year == $i ? 'selected':''}}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" id="btnEducationSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script type="text/javascript">
        let startYear = 1900;
        let endYear = new Date().getFullYear();
        for (i = endYear; i > startYear; i--)
        {
            $('#yearpicker').append($('<option />').val(i).html(i));
        }

        $(document).ready(function () {
            $('#jsc').hide();
            $('#d1_title').hide();
            $('#group').hide();
            $('#d2_title').hide();
            $('#mark').hide();
            $('#cgpa').hide();
            $('#scale').hide();
            $('#education_board').hide();

        });
        $('#result').on('change',function (){
            if ($(this).val() === '1st_class' || $(this).val() === '2nd_class'|| $(this).val() === '3rd_class') {
                $('#mark').show();
                $('#cgpa').hide();
                $('#scale').hide();
            }
            else if ($(this).val() === 'grade'){
                $('#mark').hide();
                $('#cgpa').show();
                $('#scale').show();
            }

        })

        // =============On Feature Type Change Start=============
        $('#education_level').on('change', function () {
            $('#jsc').show();
            $('#degree_title').empty()

            // =============If View Selected=============
            if ($(this).val() === 'psc') {
                $('#d1_title').show();
                $('#education_board').hide();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="PSC">PSC</option>`)
                $('#degree_title').append(`<option value="Ebtedayee">Ebtedayee (Madrasah)</option>`)
                $('#degree_title').append(`<option value="5_Pass" >5 Pass</option>`)
                $('#degree_title').append(`<option value="Other">Other</option>`)
            }
            // =============If Click Selected=============
            else if ($(this).val() === 'jsc') {
                $('#d1_title').show();
                $('#education_board').hide();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="JSC">JSC</option>`)
                $('#degree_title').append(`<option value="JDC">JDC (Madrasah)</option>`)
                $('#degree_title').append(`<option value="8_Pass">8 Pass</option>`)
                $('#degree_title').append(`<option value="Pthers">Other</option>`)
            }
            // =============If Inquiry Selected=============
            else if ($(this).val() === 'secondary') {
                $('#group').show();
                $('#d1_title').show();
                $('#education_board').show();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="SSC">SSC</option>`)
                $('#degree_title').append(`<option value="O_Level">O Level</option>`)
                $('#degree_title').append(`<option value="Dakhil">Dakhil (Madrasah)</option>`)
                $('#degree_title').append(`<option value="SSC_Vocational">SSC (Vocational)</option>`)
                $('#degree_title').append(`<option value="Others">Other</option>`)
            }
            // =============If Inquiry Selected=============
            else if ($(this).val() === 'higher_secondary') {
                $('#group').show();
                $('#d1_title').show();
                $('#education_board').show();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="HSC">HSC</option>`)
                $('#degree_title').append(`<option value="A_level">A Level</option>`)
                $('#degree_title').append(`<option value="Alim">Alim (Madrasah)</option>`)
                $('#degree_title').append(`<option value="HSC_Vocational">HSC (Vocational)</option>`)
                $('#degree_title').append(`<option value="Others">Other</option>`)

            }
            // =============If Inquiry Selected=============
            else if ($(this).val() === 'diploma') {
                $('#group').show();
                $('#education_board').hide();
                $('#d1_title').show();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="Diploma in Engineering">Diploma in Engineering</option>`)
                $('#degree_title').append(`<option value="Diploma in Medical Technology">Diploma in Medical Technology</option>`)
                $('#degree_title').append(`<option value="Diploma in Nursing">Diploma in Nursing</option>`)
                $('#degree_title').append(`<option value="Diploma in Commerce">Diploma in Commerce</option>`)
                $('#degree_title').append('<option value="Diploma in Business Studies">Diploma in Business Studies</option>')
                $('#degree_title').append('<option value="Post Graduate Diploma (PGD)">Post Graduate Diploma (PGD)</option>')
                $('#degree_title').append('<option value="Diploma in Pathology">Diploma in Pathology</option>')
                $('#degree_title').append('<option value="Diploma (Vocational)">Diploma (Vocational)</option>')
                $('#degree_title').append('<option value="Diploma in Hotel Management">Diploma in Hotel Management</option>')
                $('#degree_title').append('<option value="Diploma in Computer">Diploma in Computer</option>')
                $('#degree_title').append('<option value="Diploma in Mechanical">Diploma in Mechanical</option>')
                $('#degree_title').append('<option value="Diploma in Refrigeration and air Conditioning">Diploma in Refrigeration and air Conditioning</option>')
                $('#degree_title').append('<option value="Diploma in Electrical">Diploma in Electrical</option>')
                $('#degree_title').append('<option value="Diploma in Automobile">Diploma in Automobile</option>')
                $('#degree_title').append('<option value="Diploma in Power">Diploma in Power</option>')
                $('#degree_title').append('<option value="Diploma in Electronics">Diploma in Electronics</option>')
                $('#degree_title').append('<option value="Diploma in Architecture">Diploma in Architecture</option>')
                $('#degree_title').append('<option value="Diploma in Electro medical">Diploma in Electro medical</option>')
                $('#degree_title').append('<option value="Diploma in Civil">Diploma in Civil</option>')
                $('#degree_title').append('<option value="Diploma in Marine">Diploma in Marine</option>')
                $('#degree_title').append('<option value="Diploma in Medical">Diploma in Medical</option>')
                $('#degree_title').append('<option value="Diploma in Midwifery">Diploma in Midwifery</option>')
                $('#degree_title').append('<option value="Others">Other</option></select>')

            }
            // =============If Inquiry Selected=============
            else if ($(this).val() === 'bachelor_honors') {
                $('#group').show();
                $('#education_board').hide();
                $('#d1_title').show();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="Bachelor of Science (BSc)">Bachelor of Science (BSc)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Arts (BA)">Bachelor of Arts (BA)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Commerce (BCom)">Bachelor of Commerce (BCom)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Commerce (Pass)">Bachelor of Commerce (Pass)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Business Administration (BBA)">Bachelor of Business Administration (BBA)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Medicine and Bachelor of Surgery(MBBS)">Bachelor of Medicine and Bachelor of Surgery(MBBS)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Dental Surgery (BDS)">Bachelor of Dental Surgery (BDS)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Architecture (B.Arch)">Bachelor of Architecture (B.Arch)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Pharmacy (B.Pharm)">Bachelor of Pharmacy (B.Pharm)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Education (B.Ed)">Bachelor of Education (B.Ed)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Physical Education (BPEd)">Bachelor of Physical Education (BPEd)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Law (LLB)">Bachelor of Law (LLB)</option>`)
                $('#degree_title').append(`<option value="Doctor of Veterinary Medicine (DVM)">Doctor of Veterinary Medicine (DVM)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Social Science (BSS)">Bachelor of Social Science (BSS)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Fine Arts (B.F.A)">Bachelor of Fine Arts (B.F.A)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Business Studies (BBS)">Bachelor of Business Studies (BBS)</option>`)
                $('#degree_title').append(`<option value="Bachelor of Computer Application (BCA)">Bachelor of Computer Application (BCA)</option>`)
                $('#degree_title').append(`<option value="Fazil (Madrasah)">Fazil (Madrasah)</option>`)
                $('#degree_title').append(`<option value="Bachelor in Engineering (BEngg)">Bachelor in Engineering (BEngg)</option>`)
                $('#degree_title').append(`<option value="0thers">Other</option>`)
            }
            // =============If Inquiry Selected=============
            else if ($(this).val() === 'masters') {
                $('#group').show();
                $('#education_board').hide();
                $('#d1_title').show();
                $('#degree_title').show();
                $('#degree_title').append(`<option value="Master of Science (MSc)">Master of Science (MSc)</option>`)
                $('#degree_title').append(`<option value="Master of Arts (MA)">Master of Arts (MA)</option>`)
                $('#degree_title').append(`<option value="Master of Commerce (MCom)">Master of Commerce (MCom)</option>`)
                $('#degree_title').append(`<option value="Master of Business Administration (MBA)">Master of Business Administration (MBA)</option>`)
                $('#degree_title').append(`<option value="Master of Architecture (M.Arch)">Master of Architecture (M.Arch)</option>`)
                $('#degree_title').append(`<option value="Master of Pharmacy (M.Pharm)">Master of Pharmacy (M.Pharm)</option>`)
                $('#degree_title').append(`<option value="Master of Education (M.Ed)">Master of Education (M.Ed)</option>`)
                $('#degree_title').append(`<option value="Master of Law (LLM)">Master of Law (LLM)</option>`)
                $('#degree_title').append(`<option value="Master of Social Science (MSS)">Master of Social Science (MSS)</option>`)
                $('#degree_title').append(`<option value="Master of Fine Arts (M.F.A)">Master of Fine Arts (M.F.A)</option>`)
                $('#degree_title').append(`<option value="Master of Philosophy (M.Phil)">Master of Philosophy (M.Phil)</option>`)
                $('#degree_title').append(`<option value="Master of Business Management (MBM)">Master of Business Management (MBM)</option>`)
                $('#degree_title').append(`<option value="Master of Development Studies (MDS)">Master of Development Studies (MDS)</option>`)
                $('#degree_title').append(`<option value="Master of Business Studies (MBS)">Master of Business Studies (MBS)</option>`)
                $('#degree_title').append(`<option value="Masters in Computer Application (MCA)">Masters in Computer Application (MCA)</option>`)
                $('#degree_title').append(`<option value="Executive Master of Business Administration (EMBA)">Executive Master of Business Administration (EMBA)</option>`)
                $('#degree_title').append(`<option value="Fellowship of the College of Physicians and Surgeons (FCPS)">Fellowship of the College of Physicians and Surgeons (FCPS)</option>`)
                $('#degree_title').append(`<option value="Kamil (Madrasah)">Kamil (Madrasah)</option>`)
                $('#degree_title').append(`<option value="Masters in Engineering (MEngg)">Masters in Engineering (MEngg)</option>`)
                $('#degree_title').append(`<option value="Masters in Bank Management (MBM)">Masters in Bank Management (MBM)</option>`)
                $('#degree_title').append(`<option value="Masters in Information Systems Security (MISS)">Masters in Information Systems Security (MISS)</option>`)
                $('#degree_title').append(`<option value="Master of Information &amp; Communication Technology (MICT)">Master of Information &amp; Communication Technology (MICT)</option>`)
                $('#degree_title').append(`<option value="Others">Other</option>`)
            }
            else if ($(this).val() === 'phd') {
                $('#group').show();
                $('#d2_title').show();
                $('#d1_title').hide();
                $('#education_board').hide();
                $('#degree_title').hide();
            }
        })
    </script>
@endpush



{{--<div class="row">--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <div class="position-relative" data-select2-id="64">--}}
{{--            <label for="degree_title">Level of Education:</label><span class="text-danger">*</span>--}}
{{--            <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_level" required="">--}}
{{--                <option value="" data-select2-id="2" selected disabled>Select Option</option>--}}
{{--                <option value="secondary" {{old('secondary',$education->education_level == 'secondary') ? 'selected':''}}>Secondary</option>--}}
{{--                <option value="higher_secondary" {{old('higher_secondary',$education->education_level == 'higher_secondary') ? 'selected':''}}>Higher Secondary</option>--}}
{{--                <option value="diploma" {{old('diploma',$education->education_level == 'diploma') ? 'selected':''}}>Diploma</option>--}}
{{--                <option value="bachelor/honors" {{old('bachelor/honors',$education->education_level == 'bachelor/honors') ? 'selected':''}}>Bachelor/Honors</option>--}}
{{--                <option value="masters" {{old('masters',$education->education_level == 'masters') ? 'selected':''}}>Masters</option>--}}
{{--                --}}{{--                                            <option value="phd" {{old('phd',$education->education_level == 'phd') ? 'selected':''}}>PhD (Doctor of Philosophy)</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <label for="degree_title">Degree Title:</label><span class="text-danger">*</span>--}}
{{--        <input class="form-control" name="degree_title" type="text" id="degree_title" value="{{old('degree_title',$education->degree_title)}}" required="">--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <div class="position-relative" data-select2-id="64">--}}
{{--            <label for="degree_title">Board:</label><span class="text-danger">*</span>--}}
{{--            <select class="select2 form-select select2-hidden-accessible form-control"  tabindex="-1" aria-hidden="true" name="education_board" required="">--}}
{{--                <option value="" data-select2-id="2" selected disabled>Select Option</option>--}}
{{--                <option value="barishal" {{old('barishal',$education->education_board == 'barishal') ? 'selected':''}}>Barishal</option>--}}
{{--                <option value="chattogram" {{old('chattogram',$education->education_board == 'chattogram') ? 'selected':''}}>Chattogram</option>--}}
{{--                <option value="cumilla" {{old('cumilla',$education->education_board == 'cumilla') ? 'selected':''}}>Cumilla</option>--}}
{{--                <option value="dhaka" {{old('dhaka',$education->education_board == 'dhaka') ? 'selected':''}}>Dhaka</option>--}}
{{--                <option value="dinajpur" {{old('dinajpur',$education->education_board == 'dinajpur') ? 'selected':''}}>Dinajpur</option>--}}
{{--                <option value="jashore" {{old('jashore',$education->education_board == 'jashore') ? 'selected':''}}>Jashore</option>--}}
{{--                <option value="mymensingh" {{old('mymensingh',$education->education_board == 'mymensingh') ? 'selected':''}}>Mymensingh</option>--}}
{{--                <option value="rajshahi" {{old('rajshahi',$education->education_board == 'rajshahi') ? 'selected':''}}>Rajshahi</option>--}}
{{--                <option value="sylhet" {{old('sylhet',$education->education_board == 'sylhet') ? 'selected':''}}>Sylhet</option>--}}
{{--                <option value="madrasah" {{old('madrasah',$education->education_board == 'madrasah') ? 'selected':''}}>Madrasah</option>--}}
{{--                <option value="technical" {{old('technical',$education->education_board == 'technical') ? 'selected':''}}>Technical</option>--}}
{{--                <option value="bou" {{old('bou',$education->education_board == 'bou') ? 'selected':''}}>BOU</option>--}}
{{--                <option value="foreign_institute" {{old('foreign_institute',$education->education_board == 'foreign_institute') ? 'selected':''}}>Foreign Institute</option>--}}
{{--                <option value="other" {{old('other',$education->education_board == 'other') ? 'selected':''}}>Other</option>--}}
{{--            </select>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <label for="country">Concentration/Major/Group:</label><span class="text-danger">*</span>--}}
{{--        <input class="form-control" required="" name="group" type="text" id="group" value="{{old('result',$education->group)}}">--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <label for="institute">Institute Name:</label><span class="text-danger">*</span>--}}
{{--        <input class="form-control" required="" name="institute_name" type="text" id="institute_name" value="{{old('result',$education->institute_name)}}">--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <label for="result">Result:</label><span class="text-danger">*</span>--}}
{{--        <input class="form-control" required="" name="result" type="number" id="result" value="{{old('result',$education->result)}}">--}}
{{--    </div>--}}
{{--    <div class="form-group col-sm-6">--}}
{{--        <label for="year">Passing Year:</label><span class="text-danger">*</span>--}}
{{--        <select class="form-control" id="" name="passing_year">--}}
{{--            {{ $last= date('Y')-121 }}--}}
{{--            {{ $now = date('Y') }}--}}
{{--            @for ($i = $now; $i >= $last; $i--)--}}
{{--                <option value="{{ $i }}"  {{$education->passing_year == $i ? 'selected':''}}>{{ $i }}</option>--}}
{{--            @endfor--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}



