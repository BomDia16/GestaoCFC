<!DOCTYPE html>

<html lang="pt-br">
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Title / Icon -->
        <title>Gestão-CFC - Admins-ADM</title>
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
				<a href="{{ route('admin.index') }}" class="brand-logo">
					<li id="box-logo" style="margin-top:24px;margin-bottom:24px;" class="white-text">
						<img id="logo" class="responsive-img" src="https://www.detranmais.pr.gov.br/detran-mais/images/logo_detran01.png" />
					</li>
                </a>
                <hr>
                <li>
					<a href="{{ route('admin.admins') }}" class="white-text">   
						<i class="material-icons">assignment_ind</i>
						Admins
					</a>
                    <a href="{{ route('cfc.index') }}" class="white-text">
						<i class="material-icons">school</i>
						CFCs
					</a>
                    <a href="{{ route('user.index') }}" class="white-text">
						<i class="material-icons">person</i>
						Usuários
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
                                        {{ auth()->guard('admin')->user()->nome }}
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

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
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
                            <span class="card-title activator grey-text text-darken-4">Admins</span>
                            <button id="btn-cadastrar" class="btn waves-effect waves-light blue-grey darken-3" type="submit" name="action">
                                <a href="{{ route('admin.create') }}" class="white-text">Cadastrar</a>
                                <i class="material-icons right">add</i>
                            </button>
                        </div>
                        <hr>
                        
                        <!-- Form filtro -->
                        <span class="card-title activator grey-text text-darken-4" id="filtro">Filtrar  </span>
                        <div class="row" id="filtro">
                            <form action="{{ route('admin.search') }}" method="POST" class="col s6">
                                @csrf

                                <div class="row">
                                    <!-- ID -->
                                    <div class="col s2">
                                        <input type="text" name="id" placeholder="ID">
                                    </div>

                                    <!-- Nome -->
                                    <div class="col s4">
                                        <input type="text" name="nome" placeholder="Nome">
                                    </div>

                                    <button type="submit" class="btn waves-effect waves-light blue-grey darken-3">
                                        <i class="small material-icons">search</i>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="card-image waves-effect waves-block waves-light">
                            <table class="striped responsive-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>Email</th>
                                        <th>CPF</th>
                                        <th>Celular</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($admins as $admin)
                                    <tr>
                                        <th>{{ $admin->id }}</th>
                                        <th>{{ $admin->nome }}</th>
                                        <th>{{ $admin->email }}</th>
                                        <th>{{ $admin->cpf }}</th>
                                        <th>{{ $admin->celular }}</th>
                                        <th>
                                            <button class="btn waves-effect waves-light blue-grey darken-3">
                                                <a class="white-text" href="{{ route('admin.edit', $admin->id) }}">
                                                    <i class="small material-icons">edit</i>
                                                </a>
                                            </button>
                                            
                                        </th>
                                        <th>
                                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn waves-effect waves-light blue-grey darken-3">
                                                    <i class="small material-icons">delete</i>
                                                </button>
                                            </form>
                                        </th>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                            {!! $admins->links('vendor.pagination') !!}
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
    </body>
</html>