<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        return view('admin.settings', [
            'pageTitle' => 'Settings | Admin Panel',
            'settings' => Setting::orderBy('key')->get(),
        ]);
    }

    public function update(Request $request)
    {
        $keys = Setting::pluck('key')->all();

        $rules = [];
        foreach ($keys as $key) {
            $rules[$key] = ['nullable', 'string', 'max:1000'];
        }

        $data = $request->validate($rules);

        foreach ($keys as $key) {
            Setting::where('key', $key)->update(['value' => $data[$key] ?? null]);
        }

        return back()->with('success', 'Settings saved.');
    }
}