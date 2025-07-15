<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResumeDetail;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class ResumeController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $resume = ResumeDetail::where('user_id', $user->id)
            ->where('is_public', true)
            ->firstOrFail();

        return view('resume.show', compact('resume','username'));
    }

    public function edit()
    {
        $resume = auth()->user()->resumeDetail ?? new \App\Models\ResumeDetail();
        return view('resume.edit', compact('resume','username'));
    }

    public function update(Request $request)
    {
        $resume = auth()->user()->resumeDetail;

        $data = $request->validate([
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

        if($request->has('is_public')){
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

    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required|alpha_dash',
        ]);

        $username = $request->input('search');

        $user = User::where('username', $username)->firstOrFail();
        $resume = ResumeDetail::where('user_id', $user->id)
            ->where('is_public', true)
            ->first();

        if ($resume) {
            return redirect()->route('resume.show', ['username' => $username]);
        }

        return redirect()->back()->with('error', 'No public resume found for that username.');
    }
}
