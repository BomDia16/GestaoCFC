<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginAdminRequest;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $totalPage = 5;

    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function index_login() {
        return view('admin.login');
    }

    public function login(LoginAdminRequest $request) {
        /*if (Auth::user('webadmin')->attempt(['cpf' => $request->cpf, 'senha' => $request->senha])) {
            $details = Auth::guard('webadmin')->user();
            $user = $details['original'];
            return $user;
        } else {
            return 'auth fail';
        }*/
        $login = $this->admin->login($request->all());
        if(!$login) {
            return back()
                    ->withInput()
                    ->withErrors([
                        'As credenciais fornecidas não correspondem aos nossos registros.'
                    ]);
        }
        return redirect()->intended(route('admin.index'));
    }

    public function logout() {
        $this->admin->logout();
        return redirect()->route('admin.view');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.home');
            /*
                Lembre-se disso:
                Auth::guard('admin')->user()->id
            */
        }
        
        return redirect()->route('admin.view');
    }

    public function index_admins()
    {
        $admins = $this->admin->orderBy('id', 'ASC')->paginate($this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.admins.admins', 
                        compact('admins'));
        }
        
        return redirect()->route('admin.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.admins.admin-create');
        }

        return redirect()->route('admin.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminRequest $request)
    {
        $dados = $request->all();

        $inserir = $this->admin->inserir($dados);
        if($inserir['status']) {
            return redirect()->route('admin.admins');
        }
        return redirect()
                ->back()
                ->withErrors($inserir['message']);
    }

    public function index_usuarios()
    {
        if (Auth::guard('admin')->check()) {
            return view('admin.users.users');
        }
        
        return redirect()->route('admin.view');
    }

    public function search(Request $request, Admin $adminFiltro) {
        $dados = $request->all();
        
        $admins = $adminFiltro->searchAdmin($dados, $this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.admins.admins', 
                        compact('admins'));
        }
        
        return redirect()->route('admin.view');
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
        if (Auth::guard('admin')->check()) {
            if (!$admins = $this->admin->find($id)) {          
                return redirect()->route('admin.admins');
            }

            return view('admin.admins.edit', compact('admins'));
        }

        return redirect()->route('admin.view');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        if (!$admins = $this->admin->find($id)) {          
            return redirect()->route('admin.admins');
        }

        $dados = $request->all();

        $editando = $admins->update($dados);

        if($editando) {
            return redirect()->route('admin.admins');
        }
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->admin->findOrFail($id)->delete();

        return redirect()->route('admin.admins');
    }
}
