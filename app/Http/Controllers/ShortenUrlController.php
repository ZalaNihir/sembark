<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShortenUrlRequest;
use App\Http\Services\ShortenService;
use App\Models\ShortenUrl;

class ShortenUrlController extends Controller
{
    public function __construct(protected ShortenService $shortenService)
    {
        $this->middleware('permission:url.view')->only('index');
        $this->middleware('permission:url.create')->only('store');
        $this->middleware('permission:url.edit')->only('update');
        $this->middleware('permission:url.delete')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $urls = $this->shortenService->index(auth()->id());

        return view('urls.index', compact('urls'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShortenUrlRequest $request)
    {
        $this->shortenService->store($request->validated(), auth()->id());

        return response()->json([
            'success' => true, 'message' => 'URL shortened successfully.'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $shortenUrl = ShortenUrl::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $shortenUrl
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShortenUrlRequest $request, $id)
    {
        $this->shortenService->update($request->validated(), $id);

        return response()->json([
            'success' => true, 'message' => 'URL updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->shortenService->destroy($id, auth()->id());

        return redirect()->back()->with([
            'success' => true, 'message' => 'URL deleted successfully.'
        ]);
    }

    public function redirect($short_code)
    {
        $urlRecord = ShortenUrl::where('short_code', $short_code)->firstOrFail();
        $urlRecord->increment('counts');

        return redirect()->away($urlRecord->original_url);
    }
}
