@extends('account.master')

@section('title', 'Pedidos')

@section('content')
<div class="row order">
    {{-- @foreach($pedidos as $pedido) --}}
    <div class="col-sm-3">
        <div class="media">
            <div class="media-left media-middle">
                <div class="form-group form-group-lg">
                    <input type="checkbox" class="checkbox" />
                </div>
            </div>
            <div class="media-body">
                <h4 class="media-heading">
                    Código: {{ strtoupper(Str::random(9)) }}
                </h4>
                
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="media">
            <div class="media-body">
                <h4 class="media-heading">{{ Auth::user()->name . " " . Auth::user()->lastname  }}</h4>
                @if(isset($envio))
                <span class="fa fa-flag"></span>
                {{ $envio->localidad }},  {{ $envio->direccion }}, {{ $envio->codigo_postal }}
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="media">
            <div class="media-body media-middle">
                <p>Precio Total: €{{ $total }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="media">
            <div class="media-body media-middle processing-status">
                <h4 class="media-heading">{{ $envio->created_at->format('d-m-Y') }}</h4>
                
                {{ $envio->created_at->format('H:i:s') }}

            </div>
        </div>
    </div>
    {{-- @endforeach --}}
</div> 
@endsection
