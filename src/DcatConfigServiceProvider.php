<?php

namespace Willhill\DcatConfig;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class DcatConfigServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];

    protected $menu = [
        [
            'title' => '配置',
            'uri'   => 'dcat-config',
            'icon'  => 'fa-gear', // 图标可以留空
        ],
    ];

	public function register()
	{
		//
	}

	public function init()
	{
		parent::init();

		//

	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
