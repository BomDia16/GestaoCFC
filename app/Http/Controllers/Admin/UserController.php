<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login\LoginUserRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Models\CFC;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $totalPage = 5;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->orderBy('id', 'ASC')->paginate($this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.users.users',
                        compact('users'));
        }
        
        return redirect()->route('admin.view');
    }

    public function search(Request $request, User $userFiltro) {
        $dados = $request->all();
        
        $users = $userFiltro->searchUser($dados, $this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.users.users', 
                        compact('users'));
        }
        
        return redirect()->route('admin.view');
    }

    public function index_login() {
        return view('user.login');
    }

    public function login(LoginUserRequest $request) {
        $login = $this->user->login($request->all());
        if(!$login) {
            return back()
                    ->withInput()
                    ->withErrors([
                        'As credenciais fornecidas não correspondem aos nossos registros.'
                    ]);
        }
        return redirect()->intended(route('user.home'));
    }

    public function logout() {
        $this->user->logout();
        return redirect()->route('user.view');
    }

    public function home()
    {
        if (Auth::check()) {
            return view('user.home');
        }

        return redirect()->route('user.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cfcs = CFC::orderBy('id', 'ASC')->get();

        if (Auth::guard('admin')->check()) {
            return view('admin.users.user-create',
                        compact('cfcs'));
        }

        return redirect()->route('admin.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $dados = $request->all();

        $inserir = $this->user->inserir($dados);
        if($inserir['status']) {
            return redirect()->route('user.index');
        }
        return redirect()
                ->back()
                ->withErrors($inserir['message']);
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
            if (!$users = $this->user->find($id)) {          
                return redirect()->route('user.index');
            }

            $cfcs = CFC::orderBy('id', 'ASC')->get();

            return view('admin.users.edit', compact('users', 'cfcs'));
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
        if (!$users = $this->user->find($id)) {          
            return redirect()->route('user.index');
        }

        $dados = $request->all();

        $editando = $users->update($dados);

        if($editando) {
            return redirect()->route('user.index');
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
        $this->user->findOrFail($id)->delete();

        return redirect()->route('user.index');
    }
}
