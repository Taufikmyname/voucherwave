<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Requests\Admin\BannerRequest;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            $query = Banner::query();

            return DataTables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="flex items-center space-x-3">
                            <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="' . route('banner.edit', $item->id) . '">
                                Edit
                            </a>
                            <form action="' . route('banner.destroy', $item->id) . '" method="POST">
                                '. method_field('delete') . csrf_field() .'
                                <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="return confirm(\'Are you sure?\')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    ';

                //     <div class="flex items-center space-x-3">
                //     <a class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="' . route('category.edit', $item->id) . '">
                //         Edit
                //     </a>
                //     <form action="' . route('category.destroy', $item->id) . '" method="POST">
                //         ' . method_field('delete') . csrf_field() . '
                //         <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="return confirm(\'Are you sure?\')">
                //             Delete
                //         </button>
                //     </form>
                // </div>
                })
                ->editColumn('photo', function($item) {
                    return $item->photo ? '<img src="'. Storage::url($item->photo) .'" style="max-height: 48px;" />' : '';
                })
                ->rawColumns(['action', 'photo'])
                ->make();
        }


        return view('pages.admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerRequest $request)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/banner', 'public');

        Banner::create($data);

        return redirect()->route('banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Banner::findOrFail($id);

        return view('pages.admin.banner.edit', [
            'item'=>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerRequest $request, $id)
    {
        $data = $request->all();

        $data['photo'] = $request->file('photo')->store('assets/banner', 'public');

        $item = Banner::findOrFail($id);

        $item->update($data);

        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Banner::findOrFail($id);

        $item->delete();

        return redirect()->route('banner.index');

    }
}
