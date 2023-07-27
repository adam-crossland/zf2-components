<?php
namespace ZF2Components\View\Helper;

use GCM\Model\PackageContent;
use \Laminas\Form\View\Helper\FormRow as LaminasFormRow;
use Laminas\Form\ElementInterface;

class FormRow extends LaminasFormRow
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