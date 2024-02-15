<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Services\UserService;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $userService;
    public $breadcrumbs;
    public $pageTitle;

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

        return  view('admin.user.index', compact('breadcrumbs','pageTitle'));
    }

    public function getData(Request $request)
    {
        if($request->ajax()) {
            $users = $this->userService->getAllUsers();

            return DataTables::of($users)
            ->addColumn('action', function($row) {
                $editUrl = route('users.edit', ['id' => $row->id]);
                // $deleteUrl = route('users.delete', ['id' => $row->id]);
                $viewUrl = route('users.view', ['id' => $row->id]);

                $action = "";

                $action .= '<a href="'.$viewUrl.'" class="btn btn-sm btn-warning me-1" title="View"><i class="mdi mdi-eye"></i></a>';

                $action .= '<a href="'.$editUrl.'" class="btn btn-sm btn-info me-1"><i class="mdi mdi-pencil" title="Edit"></i></a>';

                // $action .= '<a href="'.$deleteUrl.'" class="btn btn-sm btn-danger me-1 delete-data" title="Delete"><i class="mdi mdi-delete"></i></a>';
                if($row->email != 'admin@gmail.com') {
                    $action .= '<button  type="button" class="btn btn-sm btn-danger delete-data" data-bs-toggle="modal" data-bs-target="#delete-modal" data-id="'.$row->id.'"><i class="mdi mdi-delete"></i></button>';
                }

                return $action;
            })
            ->editColumn('is_active', function($row) {
                if($row->is_active == 1) {
                    return "<span class='badge bg-success text-white'>Active</span>";
                } else {
                    return "<span class='badge bg-danger text-white'>Deactive</span>";
                }
            })
            ->filter(function ($query) use ($request) {
                if (!empty($request->get('search')) && $request->get('search')) {
                    $search = $request->get('search')['value'];

                    $query->where(function ($w) use ($search) {
                        $w->orWhere('name','LIKE', "%$search%")
                        ->orWhere('email','LIKE', "%$search%");
                        if($search == "active" || $search == "Active") {
                            $w->orWhere('is_active',1);
                        }
                        if($search == "deactive" || $search == "Deactive") {
                            $w->orWhere('is_active',0);
                        }
                    });
                }
            })
            ->rawColumns(['action','is_active'])
            ->make(true);
        }
    }

    public function create()
    {
        $pageTitle = "Create User";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Users', 'url' => route('users.index')],
            ['title' => 'Create User', 'url' => route('users.create')]
        ];

        return view('admin.user.create', compact('breadcrumbs','pageTitle'));
    }

    public function store(UserRequest $request)
    {
        $userData = $request->all();
        $user = $this->userService->createUser($userData);

        successMsg("insert", "User Created Successfully.");
        return redirect()->route('users.index');
    }

    public function edit(Request $request,$id)
    {
        $pageTitle = "Edit User";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Users', 'url' => route('users.index')],
            ['title' => 'Edit User', 'url' => '']
        ];
        $user = $this->userService->getUserById($id);

        return view('admin.user.edit', compact('user','breadcrumbs','pageTitle'));
    }

    public function update(UserRequest $request, $userId)
    {
        $userData = $request->all();
        $user = $this->userService->updateUser($userId, $userData);

        successMsg("update", "User Updated Successfully.");
        return redirect()->route('users.index');
    }

    public function delete(Request $request)
    {
        $user = $this->userService->getUserById($request->id);

        if (!$user) {
            successMsg("error", "User Not Found!!");
            return response()->json(['status' => true]);
        }

        $user->delete();
        return response()->json(['status' => true, 'message' => "User Deleted Successfully."]);
    }

    public function view($userId)
    {
        $pageTitle = "View User";
        $breadcrumbs = [
            ['title' => 'Dashboard', 'url' => route('dashboard')],
            ['title' => 'Users', 'url' => route('users.index')],
            ['title' => 'View User', 'url' => '']
        ];
        $user = $this->userService->getUserById($userId);
        return view('admin.user.view', compact('user','breadcrumbs','pageTitle'));
    }

    public function generatePdf()
    {
        $data = ['foo' => 'bar'];

        $pdf = Pdf::loadView('admin.pdf.demo', $data);

        return $pdf->download('demo.pdf');
    }
}
