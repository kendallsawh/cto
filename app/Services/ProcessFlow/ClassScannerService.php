<?php


namespace App\Services\ProcessFlow;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ClassScannerService
{
    /**
     * Get fully-qualified class names from the Conditions or Actions directory.
     * with namespace-based dropdown grouping for your conditions and actions
     * example: Transform the dropdowns from
     * -- Select Action --
     * [ ] Send Notification
     * [ ] Update Activity Status
     *
     * To:
     * -- Select Action --
     * [Notifications]
     *  - Send Notification
     * [Status]
     *  - Update Activity Status
     *
     * @param string $type 'conditions' or 'actions'
     * @return array
     */
    // app/Services/ProcessFlow/ClassScannerService.php
    public static function getGroupedClassMap(string $type = 'conditions'): array
    {
        $basePath = app_path(ucfirst($type));
        $namespaceBase = 'App\\' . ucfirst($type);
        $grouped = [];

        if (!File::isDirectory($basePath)) {
            return [];
        }

        $files = File::allFiles($basePath);

        foreach ($files as $file) {
            if ($file->getExtension() !== 'php') continue;

            $relativePath = str_replace([$basePath . DIRECTORY_SEPARATOR, '.php'], '', $file->getPathname());
            $classPath = str_replace(['/', '\\'], '\\', $relativePath);
            $fqcn = $namespaceBase . '\\' . $classPath;
            $label = Str::headline(class_basename($fqcn));
            $help = method_exists($fqcn, 'parameterHelp') ? $fqcn::parameterHelp() : '';
            $group = class_basename(dirname($fqcn)) !== ucfirst($type)
                ? class_basename(dirname($fqcn))
                : 'General';

            $grouped[$group][$fqcn] = ['label' => $label, 'help' => $help];
        }

        ksort($grouped);
        return $grouped;
    }

    //old function
    public static function getClassMap(string $type = 'conditions'): array
    {
        $basePath = app_path(ucfirst($type));
        $namespace = 'App\\' . ucfirst($type);

        if (!File::isDirectory($basePath)) {
            return [];
        }

        $files = File::files($basePath);
        $classMap = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'php') {
                $class = $namespace . '\\' . $file->getFilenameWithoutExtension();
                $label = Str::headline(class_basename($class));
                $help = method_exists($class, 'parameterHelp') ? $class::parameterHelp() : '';
                $classMap[$class] = ['label' => $label, 'help' => $help];
            }
        }

        return $classMap;
    }

}
