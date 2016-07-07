<?php
return array(
    'service_manager' => array(
        'abstract_factories' => array(),
        'factories' => array(
			//'zf2components' => 'ZF2Components\Factory\View\Helper\ZF2ComponentsHelperFactory',
			'InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Strategy\InitializablePhpRendererStrategyFactory',
			'ZF2Components\Service\View\Renderer\InitializablePhpRenderer' => 'ZF2Components\Factory\Service\View\Renderer\InitializablePhpRendererFactory',
			'ZF2Components\View\Component\Grid' => 'ZF2Components\Factory\View\Component\GridFactory',
			'ZF2Components\View\Component\Grid\Column\Standard' => 'ZF2Components\Factory\View\Component\Grid\Column\StandardFactory',
			'ZF2Components\View\Component\AccordionContent' => 'ZF2Components\Factory\View\Component\AccordionContentFactory',

			// Module Event
			'ZF2Components\EventManager' => 'ZF2Components\Factory\EventManager\EventManagerFactory',
        ),
		'invokables' => array(
			'ZF2Components\View\Component\Button' => 'ZF2Components\View\Component\Button',
			'ZF2Components\View\Component\ButtonBar' => 'ZF2Components\View\Component\ButtonBar',
			'ZF2Components\View\Component\Grid\ColumnHeader\Standard' => 'ZF2Components\View\Component\Grid\ColumnHeader\Standard',
			'ZF2Components\View\Component\Grid\ColumnData\Standard' => 'ZF2Components\View\Component\Grid\ColumnData\Standard',
			'ZF2Components\View\Component\AccordionContent\Content' => 'ZF2Components\View\Component\AccordionContent\Content',
		),
		'initializers' => array(
			'ZF2Components_ViewHelperManager' => 'ZF2Components\Initializer\View\ViewHelperManagerAwareInitializer'
		),
		'shared' => array(
			'ZF2Components\View\Component\Grid' => false,
			'ZF2Components\View\Component\Grid\Column\Standard' => false,
			'ZF2Components\View\Component\Grid\ColumnHeader\Standard' => false,
			'ZF2Components\View\Component\Grid\ColumnData\Standard' => false,
			'ZF2Components\View\Component\AccordionContent' => false,
		),
    ),
	'controllers' => array(
		'factories' => array(
			'ZF2Components\Controller\Grid' => 'ZF2Components\Factory\Controller\GridControllerFactory',
		),
	),
	'router' => array(
		'routes' => array(
			'zf2-component-grid' => array(
				'type' => 'Segment',
				'options' => array(
					'route'    => '/zf2-components/grid/:'.ZF2Components\View\Component\Grid::AJAX_IDENTIFIER.'[/]',
					'defaults' => array(
						'controller' => 'ZF2Components\Controller\Grid',
						'action'     => 'index',
						ZF2Components\View\Component\Grid::AJAX_IDENTIFIER => ZF2Components\View\Component\Grid::AJAX_IDENTIFIER,
					),
				),
				'may_terminate' => true,
			),
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
	'form_elements' => array(
		'invokables' => array(
			'ZF2Components\Form\AccordionContentForm' => 'ZF2Components\Form\AccordionContentForm',
		),
	),
	'asset_manager' => array(
		'resolver_configs' => array(
			'paths' => array(
				'ZF2Components' => __DIR__.'/../public',
			),
		),
	),
);
