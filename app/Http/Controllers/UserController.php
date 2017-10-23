<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use App\Repositories\UserRepository;


class UserController extends Controller
{
    protected $users;

    public function __construct()
    {

//        $this ->users = $users;
//        dd($users);
        $this ->middleware('token') -> only('show');

    }

    /**
     * 为指定用户显示详情
     *
     * @param int $id
     * @return Response
     * @author LaravelAcademy.org
     */
    public function show( Request $request ,$id)
    {
        $path = $request->path();
        // 不包含查询字符串
        $url = $request->url();

        // 包含查询字符串
        $url_with_query = $request->fullUrl();
        $input = $request->all();
        dd($input);
        return view('user.profile', ['user' => User::findOrFail($id)]);
    }

    /**
     * 存储新用户
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');

        //
    }
}