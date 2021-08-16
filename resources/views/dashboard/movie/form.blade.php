@extends('layouts.dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-8 align-self-center">
                    <h3>Movie</h3>
                </div>
                <div class="col-4 text-right">
                   <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal" title="delete">
                       <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="card-body">
           <div class="row">
               <div class="col-md-8 offset-md-2">
                   <form action="{{ route('dashboard.movies.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" name="title" value="">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea  class="form-control" name="description" cols="30" rows="10"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-4">
                            <div class="custom-file">
                                <label for="thumbnail" class="custom-file-label">Thumbnail</label>
                                <input type="file" name="thumbnail" class="custom-file-input">
                                @error('thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group mb-0">
                            <button type="button" onclick="window.history.back()" class="btn btn-sm btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-success">Create</button>
                        </div>
                    </form>
               </div>
           </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <div class="modal-body">
                    <p>Anda yakin ingin menghapus movie </p>
                </div>

                <div class="modal-footer">
                    <form action="{{ route('dashboard.movies.delete') }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection