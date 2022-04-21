<?php
/**
 * @link            http://www.tasko-products.de/ tasko Products GmbH
 * @copyright       (c) tasko Products GmbH 2022
 * @license         tbd
 * @author          Tobias Lorenz <tobias.lorenz@tasko.de>
 * @version         1.0.0
 */

declare(strict_types=1);

namespace TaskoProducts\Codestyle;

class PhpCsFixer
{
    public static function getDefaultRules(): array
    {
        return [
            '@PSR12' => true,
            'phpdoc_align' => [
                'align' => 'left'
            ],
            'operator_linebreak' => [
                'only_booleans' => true,
                'position' => 'end'
            ],
            'standardize_increment' => true,
            'single_quote' => true,
            'single_trait_insert_per_statement' => true,
            'fully_qualified_strict_types' => true,
            'binary_operator_spaces' => true,
            'no_unused_imports' => true,
            'no_useless_else' => true,
            'method_argument_space' => [
                'keep_multiple_spaces_after_comma' => false
            ],
            'return_assignment' => true
        ];
    }

    public static function getRules(array $additionalRules = []): array
    {
        return array_merge(self::getDefaultRules(), $additionalRules);
    }
}
