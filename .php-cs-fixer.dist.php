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

$finder = new PhpCsFixer\Finder();
$finder->in(__DIR__ . '/src/');

$additionalHeaderInformation = <<<'EOF'
This file is part of tasko-products/php-codestyle.

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.
EOF;

$config = new PhpCsFixer\Config();
$config
    ->setRules(
        TaskoProducts\Codestyle\PhpCsFixer::getRules(
            TaskoProducts\Codestyle\PhpCsFixer::getHeaderRule(
                TaskoProducts\Codestyle\PhpCsFixer::COPYRIGHT_TASKO,
                TaskoProducts\Codestyle\PhpCsFixer::LICENSE_MIT,
                'http://www.tasko-products.de/ tasko Products GmbH',
                $additionalHeaderInformation,
            )
        )
    )
    ->setFinder($finder);

return $config;
