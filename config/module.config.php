<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories' => array(
			'InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Strategy\InitializablePhpRendererStrategyFactory',
			'ZF2Components\Service\View\Renderer\InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Renderer\InitializablePhpRendererFactory',
        ),
		'invokables' => array(
			'ZF2Components\View\Component\Button' => 'ZF2Components\View\Component\Button',
			'ZF2Components\View\Component\ButtonBar' => 'ZF2Components\View\Component\ButtonBar',
		),
		'initializers' => array(
			'ViewHelperManager' => 'ZF2Components\Initializer\View\ViewHelperManagerAwareInitializer'
		),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
		'strategies' => array(
			'InitializablePhpRenderer',
			'ViewJsonStrategy',
		),
    ),
	'view_helpers' => array(
		'factories' => array(
			'zf2components' => '\ZF2Components\Factory\View\Helper\ZF2ComponentsHelperFactory',
		),
	),
);
