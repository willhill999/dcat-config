# Dcat Admin Extension
### usage

Open app/Providers/AppServiceProvider.php, and call the DConfig::load() method within the boot method:
```php
public function boot()
    {
        $table = config('admin.extensions.config.table', 'dconfig');
        if (Schema::hasTable($table)) {
            DConfig::load();
        }
    }
