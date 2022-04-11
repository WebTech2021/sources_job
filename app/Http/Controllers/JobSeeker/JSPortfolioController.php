<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker\Portfolio;
use App\Traits\UploadAble;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

class JSPortfolioController extends Controller
{
    use  UploadAble;

    public function index()
    {
        $portfolios = Portfolio::where('job_seeker_id', auth('jobSeeker')->user()->id)->get();
        return view('jobSeeker.portfolio.index', compact('portfolios'));
    }

    public function create()
    {
        return view('jobSeeker.portfolio.create');
    }

    //store data for employee portfolio
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'required|image|mimes:jpg,png',
        ]);
        $portfolio = new Portfolio;
        $portfolio->job_seeker_id = Auth::user()->id;
        $portfolio->fill($request->all());
        if ($request->hasFile('image')) {
            $filename = $this->uploadOne($request->image, 350, 250, config('imagepath.portfolio'));
            $portfolio->image = $filename;
        }
//        return $portfolio;
        $portfolio->save();
        Toastr::success('Information Added Successfully!', 'Success');
        return back();

    }

    public function show($id)
    {
        try {
            $portfolio = Portfolio::findOrFail(decrypt($id));
            return view('jobSeeker.portfolio.details', compact('portfolio'));
        } catch (DecryptException $e) {
            abort(404);
        }

    }

    public function edit($id)
    {
        try {
            $portfolio = Portfolio::findOrFail(decrypt($id));
            return view('jobSeeker.portfolio.edit', compact('portfolio'));

        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {

//        return $request->all();
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'image|mimes:jpg,png',
        ]);
        try {
            $portfolio = Portfolio::find(decrypt($id));
            if ($request->hasFile('image')) {
                $filename = $this->uploadOne($request->image, 350, 250, config('imagepath.portfolio'));
                $this->deleteOne(config('imagepath.portfolio'), $portfolio->image);
                $portfolio->update(['image' => $filename]);
            }
            $portfolio->update($request->except(['token', 'image']));
            Toastr::success('Information Update Successfully!', 'Updated');
            return redirect()->route('jobSeeker.portfolio.index');

        } catch (DecryptException $e) {
            abort(404);
        }

    }

    public function destroy($id)
    {
        try {
            $portfolio = Portfolio::findOrFail(decrypt($id));
            $portfolio->delete();
            Toastr::success('Information Deleted Successfully!', 'Deleted');
            return redirect()->route('jobSeeker.portfolio.index');

        } catch (DecryptException $e) {
            abort(404);
        }
    }
}
