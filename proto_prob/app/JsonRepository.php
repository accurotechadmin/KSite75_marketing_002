<?php
declare(strict_types=1);

final class JsonRepository
{
    public function __construct(private readonly string $basePath)
    {
        if (!is_dir($basePath) && !mkdir($basePath, 0775, true) && !is_dir($basePath)) {
            throw new RuntimeException('Unable to create data directory.');
        }
    }

    public function read(string $relativePath): array
    {
        $path = $this->path($relativePath);
        if (!is_file($path)) {
            throw new RuntimeException("Record not found: {$relativePath}");
        }
        $raw = file_get_contents($path);
        if ($raw === false) {
            throw new RuntimeException("Unable to read: {$relativePath}");
        }
        $decoded = json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        if (!is_array($decoded)) {
            throw new RuntimeException("JSON record is not an object/array: {$relativePath}");
        }
        return $decoded;
    }

    public function exists(string $relativePath): bool
    {
        return is_file($this->path($relativePath));
    }

    public function write(string $relativePath, array $data): void
    {
        $path = $this->path($relativePath);
        $directory = dirname($path);
        if (!is_dir($directory) && !mkdir($directory, 0775, true) && !is_dir($directory)) {
            throw new RuntimeException("Unable to create directory: {$directory}");
        }

        $lockPath = $path . '.lock';
        $lock = fopen($lockPath, 'c+');
        if ($lock === false) {
            throw new RuntimeException('Unable to acquire record lock.');
        }

        try {
            if (!flock($lock, LOCK_EX)) {
                throw new RuntimeException('Unable to lock record.');
            }
            $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
            $tmp = $path . '.tmp-' . bin2hex(random_bytes(6));
            if (file_put_contents($tmp, $json . PHP_EOL, LOCK_EX) === false) {
                throw new RuntimeException('Unable to write temporary JSON file.');
            }
            json_decode((string)file_get_contents($tmp), true, 512, JSON_THROW_ON_ERROR);
            if (!rename($tmp, $path)) {
                @unlink($tmp);
                throw new RuntimeException('Unable to replace JSON record atomically.');
            }
        } finally {
            flock($lock, LOCK_UN);
            fclose($lock);
            @unlink($lockPath);
        }
    }

    public function delete(string $relativePath): void
    {
        $path = $this->path($relativePath);
        if (is_file($path) && !unlink($path)) {
            throw new RuntimeException("Unable to delete: {$relativePath}");
        }
    }

    /** @return list<array<string,mixed>> */
    public function list(string $relativeDirectory): array
    {
        $directory = $this->path($relativeDirectory);
        if (!is_dir($directory)) {
            return [];
        }
        $items = [];
        foreach (glob($directory . '/*.json') ?: [] as $path) {
            $decoded = json_decode((string)file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);
            if (is_array($decoded)) {
                $items[] = $decoded;
            }
        }
        return $items;
    }

    /** @return list<string> */
    public function files(string $relativeDirectory): array
    {
        $directory = $this->path($relativeDirectory);
        if (!is_dir($directory)) {
            return [];
        }
        return array_values(array_map('basename', glob($directory . '/*.json') ?: []));
    }

    public function absolutePath(string $relativePath): string
    {
        return $this->path($relativePath);
    }

    private function path(string $relativePath): string
    {
        $relativePath = str_replace('\\', '/', trim($relativePath));
        if ($relativePath === '' || str_contains($relativePath, '..') || str_starts_with($relativePath, '/')) {
            throw new InvalidArgumentException('Unsafe data path.');
        }
        if (!preg_match('#^[A-Za-z0-9_./-]+$#', $relativePath)) {
            throw new InvalidArgumentException('Invalid data path.');
        }
        return $this->basePath . '/' . $relativePath;
    }
}
