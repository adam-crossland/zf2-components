<?php
namespace ZF2Components\View\Helper;

use GCM\Model\PackageContent;
use \Zend\Form\View\Helper\FormRow as ZendFormRow;
use Zend\Form\ElementInterface;

class FormRow extends ZendFormRow
{
    public function render(ElementInterface $element, $labelPosition = null)
    {
        $formRow = parent::render($element, $labelPosition);
        if($formRow){
            $comment = '';
            if($element->getAttribute('comment')){
                $comment = sprintf(
                    '<span class="form-text text-muted">%s</span>',
                    $element->getAttribute('comment')
                );
            }
            $formRow = sprintf(
                '<span class="form-row">%s</span>',
                $formRow.$comment
            );
        }
        return $formRow;
    }
}