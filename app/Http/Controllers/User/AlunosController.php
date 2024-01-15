<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreAlunosRequest;
use App\Http\Requests\User\UpdateAlunoRequest;
use App\Models\Alunos;
use App\Models\CFC;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlunosController extends Controller
{
    private $totalPage = 5;

    private $aluno;

    public function __construct(Alunos $aluno)
    {
        $this->aluno = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = $this->aluno->orderBy('id', 'ASC')->paginate($this->totalPage);

        if (Auth::check()) {
            return view('user.alunos',
                        compact('alunos'));
        }
        
        return redirect()->route('user.view');
    }

    public function search(Request $request, Alunos $alunoFiltro) {
        $dados = $request->all();
        
        $alunos = $alunoFiltro->searchAluno($dados, $this->totalPage);

        if (Auth::check()) {
            return view('user.alunos', 
                        compact('alunos'));
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

        if (Auth::check()) {
            return view('user.alunos-create',
                        compact('cfcs'));
        }
        
        return redirect()->route('user.view');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAlunosRequest $request)
    {
        $dados = $request->all();
        
        $inserir = $this->aluno->inserir($dados);
        if($inserir['status']) {
            return redirect()->route('aluno.index');
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
        if (Auth::check()) {
            if (!$alunos = $this->aluno->find($id)) {          
                return redirect()->route('aluno.index');
            }

            $cfcs = CFC::orderBy('id', 'ASC')->get();

            return view('user.edit', compact('alunos', 'cfcs'));
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
    public function update(UpdateAlunoRequest $request, $id)
    {
        if (!$alunos = $this->aluno->find($id)) {          
            return redirect()->route('aluno.index');
        }

        $dados = $request->all();

        $editando = $alunos->update($dados);

        if($editando) {
            return redirect()->route('aluno.index');
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
        $this->aluno->findOrFail($id)->delete();

        return redirect()->route('aluno.index');
    }
}
