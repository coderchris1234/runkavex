<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;

class AdminCmsController extends Controller
{
    use LogsAdminActivity;

    public function index(Request $request)
    {
        $query = PageSection::query();

        if ($request->filled('page')) {
            $query->where('page', $request->page);
        }

        $sections = $query->orderBy('page')->orderBy('id')->get()->groupBy('page');

        return view('admin.cms', [
            'pageTitle' => 'Content Editor | Admin Panel',
            'sections' => $sections,
            'pages' => PageSection::distinct()->orderBy('page')->pluck('page')->values(),
            'selectedPage' => $request->page ?? '',
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'sections' => ['required', 'array'],
            'sections.*' => ['nullable', 'string', 'max:10000'],
        ]);

        foreach ($data['sections'] as $key => $content) {
            PageSection::where('key', $key)->update(['content' => $content ?? null]);
        }

        $this->logActivity('cms.update', 'PageSection', null, 'Updated content for page sections');

        return back()->with('success', 'Page content saved.');
    }
}