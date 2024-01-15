<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title / Icon -->
        <title>Gestão-CFC - Alunos-Create-CFC</title>
        <link rel="icon" href="https://prontopaguei.com/images/detran-pr.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('assets/frameworks/materialize/css/materialize.css') }}">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="{{ asset('assets/css/estilo.css') }}" rel="stylesheet">
    </head>

    <body class="antialiased">
        <header>
            <!--Sidenav-->
			<ul id="sidenav" class="sidenav sidenav-fixed z-depth-0 light-blue darken-3 gradient-bottom">
				<a href="{{ route('user.home') }}" class="brand-logo">
					<li id="box-logo" style="margin-top:24px;margin-bottom:24px;" class="white-text">
						<img id="logo" class="responsive-img" src="https://www.detranmais.pr.gov.br/detran-mais/images/logo_detran01.png" />
					</li>
                </a>
                <hr>
                <li>
                    <a href="{{ route('aluno.index') }}" class="white-text">
						<i class="material-icons">people</i>
						Alunos
					</a>
				</li>
			</ul>

			<!--Navbar-->
			<nav id="nav" class="z-depth-0 grey">
				<div class="nav-wrapper">
					<a href="#" data-target="sidenav" class="sidenav-trigger">
						<i class="material-icons">menu</i>
					</a>
					<ul class="right">
						<li id="minha-conta">
							<a id="button-dropdown-my-account" class="dropdown-trigger" href="javascript:void(0);" data-target="dropdown-my-account">
								<i class="material-icons large">account_circle</i>
							</a>
							<!-- Dropdown Minha Conta -->
							<ul id="dropdown-my-account" class="dropdown-content">
                                <li>
									<a class="black-text">
                                        <i class="material-icons">person</i>
                                        {{ auth()->user()->nome }}
                                    </a>
								</li>
								<li>
									<a href="#" class="black-text">
										<i class="material-icons">settings</i>
										Minha Conta
									</a>
								</li>
								<li class="divider"></li>
								<li>
									<a class="dropdown-item black-text" href=""
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i class="material-icons">power_settings_new</i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
        </header>

        <!-- Tabela -->
        <div class="row">
            <div class="col s12 m10 l8 offset-l2 offset-m1">
                <div class="carta">
                    <div class="card">
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">Cadastro de novo Aluno</span>
                        </div>
                        <hr>
                        <div class="card-image waves-effect waves-block waves-light">
                            <form action="{{ route('aluno.store') }}" method="post">
                                @csrf
                                <!-- Nome -->
                                <div class="input-field col s6">
                                    <input name="nome" type="text" id="nome" class="validate @error('nome') is-invalid @enderror">
                                    <label for="nome">Nome</label>

                                    @error('nome')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="input-field col s6">
                                    <input name="email" id="email" type="text" class="validate @error('email') is-invalid @enderror">
                                    <label for="email">Email</label>

                                    @error('email')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <!-- cpf -->
                                <div class="input-field col s6">
                                    <input name="cpf" id="cpf" type="text" class="validate @error('cpf') is-invalid @enderror">
                                    <label for="cpf">CPF</label>

                                    @error('cpf')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <!-- celular -->
                                <div class="input-field col s6">
                                    <input name="celular" id="celular" type="text" class="validate @error('celular') is-invalid @enderror">
                                    <label for="celular">Celular</label>

                                    @error('celular')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <!-- cfc_id -->
                                <div class="input-field col s6">
                                    <select class="black-text" name="cfc_id" id="cfc_id" type="text" class="validate @error('cfc_id') is-invalid @enderror">
                                        @forelse($cfcs as $cfc)
                                            <option class="black-text" name="cfc_id" value="{{ $cfc->id }}">{{ $cfc->nome }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <label>CFC pertencente</label>

                                    @error('cfc_id')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <!-- data_nascimento -->
                                <div class="input-field col s6">
                                    <input name="data_nascimento" id="data_nascimento" type="text" class="validate @error('data_nascimento') is-invalid @enderror" placeholder="00/00/0000">
                                    <label for="data_nascimento">Data Nascimento</label>

                                    @error('data_nascimento')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- tipo carteira -->
                                <div class="input-field col s12">
                                    <select class="black-text" name="tipo_carteira" id="tipo_carteira" type="text" class="validate @error('tipo_carteira') is-invalid @enderror">
                                        <option class="black-text" name="tipo_carteira" value="A">A</option>
                                        <option class="black-text" name="tipo_carteira" value="B">B</option>
                                        <option class="black-text" name="tipo_carteira" value="C">C</option>
                                        <option class="black-text" name="tipo_carteira" value="D">D</option>
                                        <option class="black-text" name="tipo_carteira" value="E">E</option>
                                    </select>
                                    <label>Tipo de Carteira</label>

                                    @error('tipo_carteira')
                                        <div class="red-text">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <button id="cadastrar" class="btn waves-effect waves-light blue-grey darken-3" type="submit">
                                    Cadastrar
                                    <i class="material-icons right">send</i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="page-footer grey">
            <div class="footer-copyright">
                <div class="container">
                © 2021 Todos os direitos reservados ao Detran-PR
                </div>                
            </div>
        </footer>

        <!-- scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('assets/frameworks/materialize/js/materialize.js') }}"></script>
        <script src="{{ asset('assets/js/teste.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    </body>
</html>