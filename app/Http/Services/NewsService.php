<?php

namespace App\Http\Services;

use App\Events\NewsCreated;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsService
{
    public function create(array $validated, CreateNewsRequest $request)
    {
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('news', $imageName, 'public');
        }

        $news = auth()->user()->news()->create($validated);

        if ($imagePath) {
            $news->news_images()->create([
                'image_path' => $imagePath
            ]);
        }

        event(new NewsCreated($news));

        return $news;
    }

    public function update(News $news, UpdateNewsRequest $request, array $validated)
    {

        if ($request->hasFile('image')) {
            $imageName = time() . "." . $request->image->extension();
            $imagePath = $request->file('image')->storeAs('news', $imageName, 'public');

            $news->news_images()->create([
                'image_path' => $imagePath
            ]);
        }

        $news->update($validated);

        return $news;
    }

    public function delete(News $news)
    {
        foreach ($news->news_images as $image) {

            if (Storage::disk('public')->exists($image->image_path)) {

                Storage::disk('public')->delete($image->image_path);
            }
        }

        $news->delete();
    }
}
