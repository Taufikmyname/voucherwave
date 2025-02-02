<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Http\Requests\Admin\UserRequest;

use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
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
            $query = User::query();

            return Datatables::of($query)
                ->addColumn('action', function($item) {
                    return '
                        <div class="flex items-center space-x-3">
                            <a href="'.route('user.edit', $item->id).'" 
                            class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                Edit
                            </a>
                            <form action="'.route('user.destroy', $item->id).'" method="POST" class="inline">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" 
                                        class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3"
                                        onclick="return confirm(\'Are you sure?\')">
                                    Remove
                                </button>
                            </form>
                        </div>
                    ';

                //     <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">

                //     <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                //         Apple MacBook Pro 17"
                //     </th>
                //     <td class="px-6 py-4">
                //         Silver
                //     </td>
                //     <td class="px-6 py-4">
                //         Laptop
                //     </td>
                //     <td class="px-6 py-4">
                //         Yes
                //     </td>
                //     <td class="px-6 py-4">
                //         Yes
                //     </td>
                //     <td class="px-6 py-4">
                //         $2999
                //     </td>
                //     <td class="px-6 py-4">
                //         3.0 lb.
                //     </td>
                //     <td class="flex items-center px-6 py-4">
                //         <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                //         <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3">Remove</a>
                //     </td>
                // </tr>
                })
                ->rawColumns(['action'])
                ->make();
        }

        

        return view('pages.admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $data = $request->all();

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('user.index');
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
        $item = User::findOrFail($id);

        return view('pages.admin.user.edit', [
            'item' => $item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
         $data = $request->all();

        $item = User::findOrFail($id);

        if($request->password){
            $data['password'] = bcrypt($request->password);
        }
        else{
            unset($data['password']);
        }

        $item->update($data);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = User::findOrFail($id);
        $item->delete();

        return redirect()->route('user.index');
    }
}
