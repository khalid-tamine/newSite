@extends('layouts.app')


@section('content')

<div class="container"></div>
    <div class="row justify-content-around">
        <div class="col-md-8">

            <h3>liste cv</h3>
            <div class="pull-right">
                <a href="{{ url('cvs/create') }}"  class="btn btn-success">Nouveau cv</a>
            </div>

                    @foreach($cvs as $cv)

                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ asset('storage'.$cv->photo) }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">{{ $cv->titre }}</h5>
                            <p class="card-text">{{ $cv->presentation }}</p>

                            <form action="{{ url('cvs/'.$cv->id) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <a href="{{ url('cvs/'.$cv->id) }}" class="btn btn-primary" >Details</a>

                                <a href="{{ url('cvs/'.$cv->id.'/edit') }}" class="btn btn-secondary">Editer</a>

                                @can('delete',$cv)
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                @endcan

                            </form>
                        </div>
                    </div>
                    @endforeach

        </div>
    </div>
</div>


@endsection
