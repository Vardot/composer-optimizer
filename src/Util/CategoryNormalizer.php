<?php

namespace Vardot\ComposerOptimizer\Util;

/**
 * @author Kamil Samigullin <kamil@samigullin.info>
 */
final class CategoryNormalizer implements NormalizerInterface
{
    /**
     * {@inheritdoc}
     *
     * @quality:method [B]
     */
    public function normalize(array $devFiles)
    {
        $normalized = array();
        foreach ($devFiles as $i => $value) {
            if (is_numeric($i) || $i === 'other') {
                $normalized['other'][] = (array)$value;
            } else {
                $normalized[$i] = (array)$value;
            }
        }
        if (isset($normalized['other'])) {
            $normalized['other'] = array_unique(call_user_func_array('array_merge', $normalized['other']));
        }
        return $normalized;
    }
}
