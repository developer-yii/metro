<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserAjaxController extends Controller
{
    protected $userService;
    protected $breadcrumbs;
    protected $pageTitle;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $pageTitle = "Users";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Users', 'url' => route('users.index')]
        ];

        return  view('admin.user.ajax_index', compact('breadcrumbs','pageTitle'));
    }

    public function getData(Request $request)
    {
        if($request->ajax()) {
            $users = $this->userService->getAllUsers();

            return DataTables::of($users)
            ->addIndexColumn()
            ->editColumn('is_active', function($row) {
                if($row->is_active == 1) {
                    return "<span class='badge bg-success text-white'>Active</span>";
                } else {
                    return "<span class='badge bg-danger text-white'>Deactive</span>";
                }
            })
            ->addColumn('action', function($row) {
                $deleteUrl = route('users.ajax.delete', ['id' => $row->id]);

                $action = "";

                $action .= '<button type="button" class="btn btn-sm btn-warning me-1 user-view" data-id="'.$row->id.'"><i class="mdi mdi-eye"></i></button>';

                $action .= '<button type="button" class="btn btn-sm btn-info me-1 user-edit" data-bs-toggle="modal" data-bs-target="#user-modal" data-id="'.$row->id.'"><i class="mdi mdi-pencil" title="Edit"></i></button>';

                if($row->email != 'admin@gmail.com') {
                    $action .= '<button  type="button" class="btn btn-sm btn-danger delete-data" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="'.$row->id.'"><i class="mdi mdi-delete"></i></button>';
                }

                return $action;
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
        }
    }

    public function detail(Request $request)
    {
        $result = ['status' => false, 'message' => ""];
        if ($request->ajax()) {
            $user = User::find($request->id);
            $result = ['status' => true, 'message' => 'Detail get successfully.', 'data' => $user];
        }
        return response()->json($result);
    }

    public function addupdate(UserRequest $request)
    {
        if($request->ajax()) {
            $userData = $request->all();

            if($request->id) {
                $user = $this->userService->updateUser($request->id, $userData);
                return response()->json(['status' => 200, 'message' => 'User Updated Successfully.']);
            } else {
                $user = $this->userService->createUser($userData);
                return response()->json(['status' => 200, 'message' => 'User Created Successfully.']);
            }
        }
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if ($user->delete()) {
            $result = ['status' => true, 'message' => 'User Delete successfully'];
        } else {
            $result = ['status' => false, 'message' => 'User Delete fail'];
        }
        return response()->json($result);
    }
}
