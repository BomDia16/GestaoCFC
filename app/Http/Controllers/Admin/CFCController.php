<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCFCRequest;
use App\Http\Requests\Admin\UpdateCFCRequest;
use App\Models\CFC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CFCController extends Controller
{
    private $totalPage = 5;

    private $cfc;

    public function __construct(CFC $cfc)
    {
        $this->cfc = $cfc;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cfcs = $this->cfc->orderBy('id', 'ASC')->paginate($this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.cfcs.cfcs',
                        compact('cfcs'));
            /*
                Lembre-se disso:
                Auth::guard('admin')->user()->id
            */
        }
        
        return redirect()->route('admin.view');
    }

    public function search(Request $request, CFC $cfcFiltro) {
        $dados = $request->all();
        
        $cfcs = $cfcFiltro->searchCFC($dados, $this->totalPage);

        if (Auth::guard('admin')->check()) {
            return view('admin.cfcs.cfcs', 
                        compact('cfcs'));
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
            return view('admin.cfcs.cfcs-create');
        }
        return redirect()->route('admin.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCFCRequest $request)
    {
        $dados = $request->all();
        $inserir = $this->cfc->inserir($dados);

        if($inserir['status']) {
            return redirect()->route('cfc.index');
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
            if (!$cfcs = $this->cfc->find($id)) {          
                return redirect()->route('cfc.index');
            }

            return view('admin.cfcs.edit', compact('cfcs'));
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
    public function update(UpdateCFCRequest $request, $id)
    {
        if (!$cfcs = $this->cfc->find($id)) {          
            return redirect()->route('cfc.index');
        }

        $dados = $request->all();

        $editando = $cfcs->update($dados);

        if($editando) {
            return redirect()->route('cfc.index');
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
        $this->cfc->findOrFail($id)->delete();

        return redirect()->route('cfc.index');
    }
}
