<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResumeDetail;
use Illuminate\Support\Facades\Auth;



class ResumeController extends Controller
{
    public function show()
    {
        $resume = auth()->user()->resumeDetail;
        return view('resume.show', compact('resume'));
    }

    public function edit()
    {
        $resume = auth()->user()->resumeDetail ?? new \App\Models\ResumeDetail();
        return view('resume.edit', compact('resume'));
    }

    public function update(Request $request)
    {
        $resume = auth()->user()->resumeDetail;

        $data = $request->validate([
            'resume_username' => [
                'required',
                'alpha_dash',
                'unique:resume_details,resume_username,' . ($resume->id ?? 'null'),
            ],
            'photo' => 'nullable|image|max:2048',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'resume_body' => 'nullable|string',
            'is_public' => 'nullable|boolean',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('photos', 'public');
        }

        if (!$data['resume_username']) {
            $data['is_public'] = false;
        } else {
            $data['is_public'] = $request->has('is_public');
        }

        if ($resume) {
            $resume->update($data);
        } else {
            $data['user_id'] = auth()->id();
            ResumeDetail::create($data);
        }

        return redirect()->route('resume.edit')->with('success', 'Resume updated!');
    }

    public function publicShow($username)
    {
        $resume = ResumeDetail::where('resume_username', $username)
            ->where('is_public', true)
            ->firstOrFail();

        return view('resume.public_show', compact('resume'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'q' => 'required|alpha_dash',
        ]);

        $username = $request->input('q');

        $resume = ResumeDetail::where('resume_username', $username)
            ->where('is_public', true)
            ->first();

        if ($resume) {
            return redirect()->route('resume.public.show', ['username' => $username]);
        }

        return redirect()->back()->with('error', 'No public resume found for that username.');
    }
}
