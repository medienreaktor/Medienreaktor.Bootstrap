<?php
namespace Medienreaktor\Bootstrap\FusionObjects;

use Neos\Flow\Annotations as Flow;
use Neos\Fusion\Service\HtmlAugmenter;

/**
 * A Fusion Augmenter-Object
 *
 * The fusion object can be used to add html-attributes to the rendered content
 *
 * @api
 */
class AugmenterImplementation extends \Neos\Fusion\FusionObjects\AugmenterImplementation
{

    /**
     * @return string
     */
    public function evaluate()
    {
        $content = $this->fusionValue('content');
        $fallbackTagName = $this->fusionValue('fallbackTagName');

        $sortedChildFusionKeys = $this->sortNestedFusionKeys();

        $values = [];
        foreach ($sortedChildFusionKeys as $key) {
            if ($fusionValue = $this->fusionValue($key)) {
                $values[$key] = $fusionValue;
            }
        }

        $attributes = [];

        $className = $values['className'] ? $values['className'] : 'component';
        $classes = [$className];
        if (isset($values['theme'])) {
            if (isset($values['outline']) && $values['outline']) {
                $classes[] = $className.'-outline-'.$values['theme'];
            } else {
                $classes[] = $className.'-'.$values['theme'];
            }
        }
        if (isset($values['size'])) {
            $classes[] = $className.'-'.$values['size'];
        }
        if (isset($values['classAppend']) && $values['classAppend']) {
            $classes[] = $className.'-'.$values['classAppend'];
        }
        $attributes['class'] = implode($classes, ' ');

        if (isset($values['type'])) {
            $attributes['type'] = $values['type'];
        }

        if ($attributes && is_array($attributes) && count($attributes) > 0) {
            return $this->htmlAugmenter->addAttributes($content, $attributes, $fallbackTagName);
        } else {
            return $content;
        }
    }
}
