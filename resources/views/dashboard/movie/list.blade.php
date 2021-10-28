@extends('layouts.dashboard')

@section('content')
    <div class="mb-2">
        <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary-outline btn-sm">+ Movie</a>
    </div>


    @if (session()->has('message'))
        <div class="alert alert-success">
            <strong>{{ __(session()->get('message'), ['title' => 'Laut']) }}</strong>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movies</h3>
                </div>
                <div class="col-4">
                    <form action="{{ url('dashboard/movies') }}" method="GET">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-sm" title="search" name="search" value="{{ $request['search'] ?? '' }}">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if ($movies->total())
                <table class="table table-striped table-borderless table-hover">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>
                                    <img  class="img-fluid" src="{{ asset('storage/movies/'. $movie->thumbnail) }}">
                                </td>
                                <td class="col-thumbnail"><h4><strong>{{ $movie->title }}</strong></h4></td>
                                <td>
                                    <a href="{{ route('dashboard.movies.edit', $movie->id) }}" title="edit" class="btn btn-success btn-sm"><i class="fas fa-pen"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $movies->appends($request)->links() }}

            @else
                <h4 class="text-center p-3">{{ __('messages.no_data', ['module' => 'Movies']) }}</h4>
            @endif
        </div>
    </div>
    
@endsection