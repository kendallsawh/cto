<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel{{$permission->id}}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="descriptionModalLabel{{$permission->id}}">Permission</h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <div class="">

            </div>

            <div class="modal-body">
                <p>Here you can view and edit the permission.</p>
                <form method="POST" id="permission-form" action="{{ route('permissions.update', $permission->id)}}"  >
                    @method('patch')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input value="{{ $permission->name }}" 
                            id="permission-name"
                            type="text" 
                            class="form-control" 
                            name="name" 
                            placeholder="Name" required>
    
                        @if ($errors->has('name'))
                            <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Description</label>
                        <input value="{{$permission->description }}" 
                            type="text" 
                            class="form-control" 
                            name="description" 
                            id="permission-description"
                            placeholder="Description" required>
    
                        @if ($errors->has('description'))
                            <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
    
                    <button type="submit" class="btn btn-primary">Save permission</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function clearform()
    {
        document.getElementById('permission-name').value= ""
    document.getElementById('permission-description').value=""
   // document.getElementById('permission-form').action=""
    }
    
</script>
