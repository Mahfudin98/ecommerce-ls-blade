<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $role = Role::orderBy('created_at', 'DESC')->paginate(10);
        return view('role.index', compact('role'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        $role = Role::firstOrCreate(['name' => $request->name]);
        return redirect()->back()->with(['success' => 'Role: ' . $role->name . ' Ditambahkan']);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return redirect()->back()->with(['success' => 'Role: ' . $role->name . ' Dihapus']);
    }
}
