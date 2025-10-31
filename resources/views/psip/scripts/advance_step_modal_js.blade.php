<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('advanceStepModal');
    const form = document.getElementById('advance-step-form');

    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const instanceId = button.getAttribute('data-instance-id');
        const stepName = button.getAttribute('data-step-name');
        const stepDescription = button.getAttribute('data-step-description');
        const conditions = JSON.parse(button.getAttribute('data-conditions') || '[]');
        const actions = JSON.parse(button.getAttribute('data-actions') || '[]');

        // Set form action
        form.action = `/process-builder/advance/${instanceId}`;

        // Populate step name and description
        document.getElementById('modal-step-name').innerText = stepName || '-';
        document.getElementById('modal-step-description').innerText = stepDescription || '';

        // Populate conditions
        const condList = document.getElementById('modal-conditions');
        condList.innerHTML = '';
        if (conditions.length === 0) {
            condList.innerHTML = '<li class="list-group-item text-muted">No conditions configured.</li>';
        } else {
            conditions.forEach(c => {
                condList.innerHTML += `<li class="list-group-item"><strong>${c.type}</strong><br><code>${formatParam(c.parameter)}</code></li>`;
            });
        }

        // Populate actions
        const actList = document.getElementById('modal-actions');
        actList.innerHTML = '';
        if (actions.length === 0) {
            actList.innerHTML = '<li class="list-group-item text-muted">No actions configured.</li>';
        } else {
            actions.forEach(a => {
                actList.innerHTML += `<li class="list-group-item"><strong>${a.type}</strong><br><code>${formatParam(a.parameter)}</code></li>`;
            });
        }
    });

    function formatParam(param) {
        try {
            const parsed = JSON.parse(param);
            return JSON.stringify(parsed, null, 2);
        } catch {
            return param;
        }
    }
});
</script>
