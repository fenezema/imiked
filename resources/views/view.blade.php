@extends('base_.base')
@section('title')
    Pelaporan Imigrasi
@stop
@section('head')
@stop

@section('count')
    <?php
        $jml = Count($stat);
    ?>
    {{$jml}}
@stop

@section('notif')
    @foreach($stat as $n)
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">
            <span class="text-success">
            <strong>
            <i class="fa fa-long-arrow-up fa-fw"></i>{{$n->kot}}</strong>
            </span>
            <span class="small float-right text-muted">{{$n->created_at}}</span>
            <div class="dropdown-message small">{{$n->keterangan}}</div>
        </a>
    @endforeach
@stop

@section('content')
@stop

@section('script')
@stop