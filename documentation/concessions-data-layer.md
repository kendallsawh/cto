# Concessions Data Layer

This module introduces normalized concession applications with reusable statuses, measurement units, and catalogued items.

## Key tables
- `concession_statuses` — normalized state machine with a default `pending` row.
- `measurement_units` — agriculture-friendly units with dimensions and notes.
- `item_categories` / `items` — catalog support with optional default units.
- `concession_applications` — polymorphic applicant, status tracking, soft deletes.
- `concession_application_items` — item snapshots with unit snapshots for audit stability.
- `concession_approvals` & `attachments` — workflow logs and file support.

## Models & scopes
- `ConcessionApplication::ownedBy($user)` — filter by owner.
- `ConcessionApplication::withStatusCode([...])` — filter by normalized status codes.
- `ConcessionApplication::search($term)` — search reference numbers and applicant names.
- `$application->total_requested_amount` — totals all line items.

Example usage:
```php
// Reviewer queue for submitted apps
ConcessionApplication::withStatusCode(['submitted'])
    ->with(['user', 'applicant', 'status'])
    ->paginate(20);
```

## Seeders
Local/test environments run:
- `ConcessionStatusSeeder`
- `MeasurementUnitSeeder`
- `ItemCategorySeeder` & `ItemsSeeder`
- `ConcessionsDemoSeeder` for sample applications.

Run manually if needed:
```bash
php artisan db:seed --class=ConcessionStatusSeeder
php artisan db:seed --class=MeasurementUnitSeeder
```
