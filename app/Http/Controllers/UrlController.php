<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUrlRequest;
use App\Models\Url;
use Illuminate\Http\RedirectResponse;

class UrlController extends Controller
{

    public function index()
    {
        return view('index', [
            'urls' => Url::all()
        ]);
    }


    public function create()
    {
        return view('welcome');
    }


    public function store(StoreUrlRequest $request): RedirectResponse
    {
        $url = Url::normalizeUrl(
            $request
                ->input('url.name')
        );
        Url::create($url);

        flash('Url добавлен')
            ->success();
        $currentUrl = Url::getLastRecord();

        return redirect()
            ->route('urls.show', $currentUrl->id);
    }


    public function show(int $id)
    {
        return view('show', [
            'url' => Url::findById($id)
        ]);
    }

    public function check(int $id)
    {
        //TODO check url code...
    }
}
