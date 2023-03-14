<?php
/**
 * @copyright   (c) tasko Products GmbH 2021
 * @license     http://www.opensource.org/licenses/mit-license.html MIT License
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
            'operator_linebreak' => true,
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
            'function_typehint_space' => true,
            'ordered_imports' => true,
            'trailing_comma_in_multiline' => ['after_heredoc' => false]
        ];
    }

    public static function getRules(array $additionalRules = []): array
    {
        return array_merge(self::getDefaultRules(), $additionalRules);
    }
}
