<?php
namespace Willhill\DcatConfig;

use Willhill\DcatConfig\Models\DcatConfig as DcatConfigModel;

class DConfig {
    public static function load()
    {
        foreach (DcatConfigModel::all(['name', 'value']) as $config) {
            config([$config['name'] => $config['value']]);
        }
    }
}
