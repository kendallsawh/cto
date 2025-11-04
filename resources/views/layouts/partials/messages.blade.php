<!-- Display Error Messages -->
@if(isset($errors) && count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Display Success Messages -->
@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <i class="fa fa-check"></i>
            {{ $data }}
        </div>
    @endif
@endif

<!-- Display Warning Messages (Example, Optional) -->
@if(Session::get('warning', false))
    <?php $data = Session::get('warning'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-warning" role="alert">
                <i class="fa fa-exclamation-triangle"></i>
                {{ $msg }}
            </div>
        @endforeach
    @else
        <div class="alert alert-warning" role="alert">
            <i class="fa fa-exclamation-triangle"></i>
            {{ $data }}
        </div>
    @endif
@endif

<!-- Display Error Messages 2 -->
@if ($errors->any() || session('error'))
    <div class="alert alert-danger">
        <ul class="mb-0">
            {{-- Display the general session error, if it exists --}}
            @if (session('error'))
                <li>{{ session('error') }}</li>
            @endif

            {{-- List all validation errors --}}
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
