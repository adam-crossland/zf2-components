<?php
namespace ZF2Components\Form;

use Laminas\Form\Form;

class AccordionContentForm extends Form
{
	public function __construct(
        $name = null,
        $options = array()
    ){
        parent::__construct($name, $options);
    }

    public function init()
    {
	}
}