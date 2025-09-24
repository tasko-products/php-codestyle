<?php

/**
 * @link         http://www.tasko-products.de/ tasko Products GmbH
 * @copyright    (c) tasko Products GmbH
 * @license      http://www.opensource.org/licenses/mit-license.html MIT License
 *
 * This file is part of tasko-products/php-codestyle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace TaskoProducts\Codestyle;

class PhpCsFixer
{
    public const COPYRIGHT_TASKO = '(c) tasko Products GmbH';
    public const LICENSE_COMMERCIAL = 'Commercial';
    public const LICENSE_MIT = 'http://www.opensource.org/licenses'
        .'/mit-license.html MIT License';

    public static function getDefaultRules(): array
    {
        return [
            '@PSR12' => true,
            'phpdoc_align' => [
                'align' => 'left',
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
                'keep_multiple_spaces_after_comma' => false,
            ],
            'function_typehint_space' => true,
            'ordered_imports' => true,
            'trailing_comma_in_multiline' => [
                'after_heredoc' => false,
                'elements' => [
                    'arguments',
                    'arrays',
                    'parameters',
                ],
            ],
            'multiline_whitespace_before_semicolons' => [
                'strategy' => 'new_line_for_chained_calls',
            ],
            'no_superfluous_phpdoc_tags' => true,
            'no_empty_phpdoc' => true,
            'no_extra_blank_lines' => true,
            'strict_comparison' => true,
            'strict_param' => true,
        ];
    }

    public static function getHeaderRule(
        string $copyright = '(c) tasko Products GmbH',
        string $license = self::LICENSE_COMMERCIAL,
        ?string $link = null,
        ?string $additionalInformation = null,
    ): array {
        $fileHeaderComment = <<<'EOF'
@copyright    %s
@license      %s
EOF;

        $fileHeaderComment = sprintf($fileHeaderComment, $copyright, $license);

        if ($link !== null) {
            $linkHeaderComment = <<<'EOF'
@link         %s
%s
EOF;

            $fileHeaderComment = sprintf(
                $linkHeaderComment,
                $link,
                $fileHeaderComment,
            );
        }

        if ($additionalInformation !== null) {
            $additionalInformationHeaderComment = <<<'EOF'
%s

%s
EOF;

            $fileHeaderComment = sprintf(
                $additionalInformationHeaderComment,
                $fileHeaderComment,
                $additionalInformation,
            );
        }

        return [
            'header_comment' => [
                'header' => $fileHeaderComment,
                'comment_type' => 'PHPDoc',
                'location' => 'after_open',
                'separate' => 'bottom',
            ],
        ];
    }

    public static function getRules(array $additionalRules = []): array
    {
        return array_merge(self::getDefaultRules(), $additionalRules);
    }
}
