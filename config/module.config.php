<?php

return array(
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories' => array(
			'InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Strategy\InitializablePhpRendererStrategyFactory',
			'ZF2Components\Service\View\Renderer\InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Renderer\InitializablePhpRendererFactory',
        ),
		'invokables' => array(
		),
		'initializers' => array(
			'ViewHelperManager' => 'ZF2Components\Initializer\View\ViewHelperManagerAwareInitializer'
		),
    ),
//    'translator' => array(
//        'locale' => 'en_US',
//        'translation_file_patterns' => array(
//            array(
//                'type'     => 'gettext',
//                'base_dir' => __DIR__ . '/../language',
//                'pattern'  => '%s.mo',
//            ),
//        ),
//    ),
//    'controllers' => array(
//        'invokables' => array(
//            'Application\Controller\Index' => Controller\IndexController::class
//        ),
//    ),
    'view_manager' => array(
//        'display_not_found_reason' => true,
//        'display_exceptions'       => true,
//        'doctype'                  => 'HTML5',
//        'not_found_template'       => 'error/404',
//        'exception_template'       => 'error/index',
//        'template_map' => array(
//            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
//            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
//            'error/404'               => __DIR__ . '/../view/error/404.phtml',
//            'error/index'             => __DIR__ . '/../view/error/index.phtml',
//        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
		'strategies' => array(
			'InitializablePhpRenderer',
			'ViewJsonStrategy',
		),
    ),
);
