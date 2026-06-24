<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Http\Services\NewsService;
use App\Models\News;
use App\Models\NewsImage;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function __construct(
        protected NewsService $newsService
    ) {}

    public function index()
    {
        $news = News::latest()->take(10)->get();
        return response()->json([
            'message' => 'All leatest News',
            'news' => $news->load('news_images')
        ], 200);
    }

    public function newsOfJournalist(User $jour)
    {
        $news = $jour->news()->latest()->paginate(10);
        return response()->json([
            'message' => "$jour->name News",
            'news' => $news
        ]);
    }

    public function show(News $news)
    {
        return response()->json([
            'news' => $news->load('news_images')
        ]);
    }

    public function store(CreateNewsRequest $request)
    {
        $this->authorize('create',News::class);
        $validated = $request->validated();
        $news = $this->newsService->create($validated, $request);

        return response()->json([
            'message' => 'A News Article Created successfully',
            'article' => $news->load('news_images')
        ], 201);
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $this->authorize('update',$news);
        $validated = $request->validated();

        $updatedNews = $this->newsService->update($news, $request, $validated);

        return response()->json([
            'message' => 'Article updated Successfully',
            'article' => $updatedNews->load('news_images')
        ]);
    }

    public function deleteNewsImages(NewsImage $newsImage)
    {
        $this->authorize('update',$newsImage->news);
        if($newsImage && Storage::disk('public')->exists($newsImage->image_path)){
            Storage::disk('public')->delete($newsImage->image_path  );
        }

        $newsImage->delete();

        return response()->json([
            'message'=>'Image deleted successfully'
        ]);
    }

    public function deleteNews(News $news)
    {
        $this->authorize('delete');
        $this->newsService->delete($news);

        return response()->json([
            'message'=>'Article deleted successfully'
        ]);
    }
}
