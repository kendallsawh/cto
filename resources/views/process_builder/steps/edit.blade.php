@extends('layouts.app-master')

@section('content')
<div class="container mt-4">
    <h2>Edit Step: {{ $step->name }}: {{ $step->flow->name }}</h2>

    <form method="POST" action="{{ route('process_builder.steps.store', $step->flow->id) }}">
        @csrf

        <div class="mb-3">
            <label>Step Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Step Order</label>
            <input type="number" name="order" class="form-control" required>
        </div>

        <hr>
        <h5>Conditions</h5>
        <div id="conditions-wrapper">
            <div class="input-group mb-2">
                <select name="conditions[0][type]" class="form-select me-2 condition-select" data-target="condition-help-0">
                    <option value="">-- Select Condition --</option>
                    @foreach($conditionGroups as $group => $classes)
                        <optgroup label="{{ $group }}">
                            @foreach($classes as $class => $meta)
                                <option value="{{ $class }}" data-help="{{ $meta['help'] }}">{{ $meta['label'] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <input type="text" name="conditions[0][parameter]" class="form-control" placeholder='Parameters (JSON or key=value)'>
                <button type="button" class="btn btn-outline-danger remove-condition">X</button>
            </div>
            <small class="text-muted d-block" id="condition-help-0"></small>
        </div>
        <button type="button" class="btn btn-outline-primary mb-3" id="add-condition">Add Condition</button>

        <hr>
        <h5>Actions</h5>
        <div id="actions-wrapper">
            <div class="input-group mb-2">
                <select name="actions[0][type]" class="form-select me-2 action-select" data-target="action-help-0">
                    <option value="">-- Select Action --</option>
                    @foreach($actionGroups as $group => $classes)
                        <optgroup label="{{ $group }}">
                            @foreach($classes as $class => $meta)
                                <option value="{{ $class }}" data-help="{{ $meta['help'] }}">{{ $meta['label'] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
                <input type="text" name="actions[0][parameter]" class="form-control" placeholder='Parameters (JSON or key=value)'>
                <button type="button" class="btn btn-outline-danger remove-action">X</button>
            </div>
            <small class="text-muted d-block" id="action-help-0"></small>
        </div>
        <button type="button" class="btn btn-outline-primary mb-3" id="add-action">Add Action</button>

        <hr>
        <button class="btn btn-success">Save Step</button>
        <a href="{{ route('process_builder.edit', $step->flow->id) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
function bindParameterHelpEvents(type) {
    const selectorClass = type === 'condition' ? 'condition-select' : 'action-select';
    document.querySelectorAll(`.${selectorClass}`).forEach(select => {
        select.addEventListener('change', function () {
            const helpText = this.selectedOptions[0].dataset.help || '';
            const targetId = this.getAttribute('data-target');
            if (targetId) {
                document.getElementById(targetId).textContent = helpText;
            }
        });

        select.dispatchEvent(new Event('change'));
    });
}

document.addEventListener('DOMContentLoaded', () => {
    let condIndex = 1;
    let actIndex = 1;

    const condTemplate = () => `
        <div class="input-group mb-2">
            <select name="conditions[\${condIndex}][type]" class="form-select me-2 condition-select" data-target="condition-help-\${condIndex}">
                <option value="">-- Select Condition --</option>
                @foreach($conditionGroups as $group => $classes)
                    <optgroup label="{{ $group }}">
                            @foreach($classes as $class => $meta)
                                <option value="{{ $class }}" data-help="{{ $meta['help'] }}">{{ $meta['label'] }}</option>
                            @endforeach
                    </optgroup>
                @endforeach
            </select>
            <input type="text" name="conditions[\${condIndex}][parameter]" class="form-control" placeholder='Parameters'>
            <button type="button" class="btn btn-outline-danger remove-condition">X</button>
            <small class="text-muted d-block" id="condition-help-\${condIndex}"></small>
        </div>`;

    const actTemplate = () => `
        <div class="input-group mb-2">
            <select name="actions[\${actIndex}][type]" class="form-select me-2 action-select" data-target="action-help-\${actIndex}">
                <option value="">-- Select Action --</option>
                @foreach($actionGroups as $group => $classes)
                    <optgroup label="{{ $group }}">
                            @foreach($classes as $class => $meta)
                                <option value="{{ $class }}" data-help="{{ $meta['help'] }}">{{ $meta['label'] }}</option>
                            @endforeach
                    </optgroup>
                @endforeach
            </select>
            <input type="text" name="actions[\${actIndex}][parameter]" class="form-control" placeholder='Parameters'>
            <button type="button" class="btn btn-outline-danger remove-action">X</button>
            <small class="text-muted d-block" id="action-help-\${actIndex}"></small>
        </div>`;

    document.getElementById('add-condition').addEventListener('click', () => {
        document.getElementById('conditions-wrapper').insertAdjacentHTML('beforeend', condTemplate());
        bindParameterHelpEvents('condition');
        condIndex++;
    });

    document.getElementById('conditions-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-condition')) {
            e.target.closest('.input-group').remove();
        }
    });

    document.getElementById('add-action').addEventListener('click', () => {
        document.getElementById('actions-wrapper').insertAdjacentHTML('beforeend', actTemplate());
        bindParameterHelpEvents('action');
        actIndex++;
    });

    document.getElementById('actions-wrapper').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-action')) {
            e.target.closest('.input-group').remove();
        }
    });

    bindParameterHelpEvents('condition');
    bindParameterHelpEvents('action');
});
</script>
@endsection
