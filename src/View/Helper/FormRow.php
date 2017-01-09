<?php
namespace ZF2Components\View\Helper;

use \Zend\Form\View\Helper\FormRow as ZendFormRow;
use Zend\Form\ElementInterface;

class FormRow extends ZendFormRow
{
    public function render(ElementInterface $element, $labelPosition = null)
    {
        $formRow = parent::render($element, $labelPosition);
        if($formRow){
            $formRow = sprintf(
                '<span class="form-row">%s</span>',
                $formRow
            );
        }
        return $formRow;
    }
}