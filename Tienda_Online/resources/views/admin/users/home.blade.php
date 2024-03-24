@extends('admin.master')

@section('title', 'Usuarios')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/users')}}"><i class="fas fa-user"></i> Listado de Usuarios</a>
</li>
@endsection



@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title"><i class="fas fa-user"></i>Listado de Usuarios</h2>
            </div>
            <div class="inside">
                <table class="table">
                    <thead>

                        <tr>
                            <td> ID </td>
                            <td>Nombre</td>
                            <td>Apellido</td>
                            <td>Email</td>
                            <td></td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as  $user )
                            <tr>
                                <td>{{ $user->id}} </td>
                                <td>{{ $user->name}} </td>
                                <td>{{ $user->lastname}} </td>
                                <td>{{ $user->email}} </td>
                                <td>
                                    <div class="opts">

                                        <a href="{{ url('/admin/users/' .$user->id. '/edit')}}" class="a" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="{{ url('/admin/users/' .$user->id. '/delete')}}" class="a" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
@endsection
