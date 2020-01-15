@extends('principal')
@section('contenido')
    <templete v-if="menu==0">
        @include('aplicacion.nueva_acta')
    </templete>
    <templete v-if="menu==1">
        <h1>contenido del elemento 2</h1>
    </templete>
    <templete v-if="menu==2">
        <h1>contenido del elemento 3</h1>
    </templete>
    <templete v-if="menu==3">
        <h1>contenido del elemento 4</h1>
    </templete>
    <templete v-if="menu==4">
        <h1>contenido del elemento 5</h1>
    </templete>
    
@endsection