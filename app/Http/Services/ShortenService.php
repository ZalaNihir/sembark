<?php

namespace App\Http\Services;

use App\Models\ShortenUrl;
use Illuminate\Support\Str;

class ShortenService
{
    public function index($userId)
    {
        return ShortenUrl::where('user_id', $userId)->paginate(10);
    }

    public function store(array $data, $userId)
    {
        $data['user_id'] = $userId;
        $data['short_code'] = $data['short_code'] ?? Str::random(6);

        return ShortenUrl::create($data);
    }

    public function update(array $data, $id)
    {
        $shortenUrl = ShortenUrl::findOrFail($id);
        $data['counts'] = 0;

        return $shortenUrl->update($data);
    }

    public function destroy($id, $userId)
    {
        $shortenUrl = ShortenUrl::findOrFail($id);
        if(!$shortenUrl->user_id){
            return abort(404);
        }

        if($shortenUrl->user_id != $userId){
            return abort(404);
        }

        return $shortenUrl->delete();
    }
}
