@extends("layouts.app")

@section("content")

<h1 class="my-5">Types</h1>

<table class="table table-primary table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Color</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($types as $type)
        <tr>
        <th scope="row">{{$type->id}}</th>
        <td>{{$type->name}}</td>
        <td>{{$type->color}}</td>
        <td class="d-flex justify-content-between pe-3">
            <a href="{{route("admin.types.show", $type)}}">
                <i class="bi bi-eyeglasses" rel="tooltip" title="More details"></i>
            </a>

            <a href="{{route("admin.types.edit", $type)}}">
                <i class="bi bi-pencil" rel="tooltip" title="Edit"></i>
            </a>

            <button class="bi bi-trash" rel="tooltip" title="Kill" data-bs-toggle="modal" data-bs-target="#delete-modal-{{$type->id}}"></button>
        </td>
        </tr>
        @empty
        <p>no types available</p>
        @endforelse
    </tbody>
</table> 

{{$types->links()}}


<div class="my-3 d-flex w-100 justify-content-end">
    <a href="{{ route('admin.types.create') }}" type="button" class="btn btn-outline-primary">+ add new category</a>
</div>

@endsection

@section("modals")
@foreach($types as $type)

<div class="modal fade" id="delete-modal-{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Warning!</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you wanna delete {{$type->name}}? <br> This operation is not reversible!
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go back</button>
        <form action="{{ route('admin.types.destroy', $type) }}" method="POST">
            @method("delete")
            @csrf
            <button type="submit" class="btn btn-primary">Yes, delete!</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endforeach
@endsection