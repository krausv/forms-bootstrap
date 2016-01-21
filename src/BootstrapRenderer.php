<?php

namespace Krausv\Form\Renderer;

use Nette;
use Nette\Forms\Rendering\DefaultFormRenderer;
use Nette\Forms\Controls;

class BootstrapRenderer extends DefaultFormRenderer
{
    public $wrappers = array(
        'form' => array(
            'container' => null,
        ),
        'hidden' => array(
            'container' => 'div',
        ),
        'error' => array(
            'container' => 'div class="alert alert-danger"',
            'item' => 'p',
        ),
        'controls' => array(
            'container' => 'div',
        ),
        'label' => array(
            'container' => 'div class="col-sm-3 control-label"',
            'suffix' => null,
            'requiredsuffix' => '',
        ),
        'group' => array(
            'container' => 'fieldset',
            'label' => 'legend',
            'description' => 'p',
        ),
        'pair' => array(
            'container' => 'div class=form-group',
            '.required' => 'required',
            '.optional' => null,
            '.odd' => null,
            '.error' => 'has-error',
        ),
        'control' => array(
            'container' => 'div class=col-sm-9',
            '.odd' => null,
            'description' => 'span class=help-block',
            'requiredsuffix' => '',
            'errorcontainer' => 'span class=help-block',
            'erroritem' => '',
            '.required' => 'required',
            '.text' => 'text',
            '.password' => 'text',
            '.file' => 'text',
            '.submit' => 'button',
            '.image' => 'imagebutton',
            '.button' => 'button',
        ),
    );

    /**
     * @param Nette\Forms\Form $form
     * @param null             $mode
     *
     * @return mixed
     */
    public function render(Nette\Forms\Form $form, $mode = null)
    {
        $form->getElementPrototype()->addClass('form-horizontal');
        $form->getElementPrototype()->setNovalidate('novalidate');
        foreach ($form->getControls() as $control) {
            if ($control instanceof Controls\Button) {
                if (strpos($control->getControlPrototype()->getClass(), 'btn') === FALSE) {
                    $control->getControlPrototype()->addClass(empty($usedPrimary) ? 'btn btn-primary' : 'btn btn-default');
                    $usedPrimary = true;
                }
            } elseif ($control instanceof Controls\TextBase ||
                $control instanceof Controls\SelectBox ||
                $control instanceof Controls\MultiSelectBox) {
                $control->getControlPrototype()->addClass('form-control');
            } elseif ($control instanceof Controls\Checkbox ||
                $control instanceof Controls\CheckboxList ||
                $control instanceof Controls\RadioList) {
                $control->getSeparatorPrototype()->setName('div')->addClass($control->getControlPrototype()->type);
            }
        }
        return parent::render($form, $mode);
    }
}
