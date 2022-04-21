<?php
/**
 * @link            http://www.tasko-products.de/ tasko Products GmbH
 * @copyright       (c) tasko Products GmbH 2022
 * @license         tbd
 * @author          Tobias Lorenz <tobias.lorenz@tasko.de>
 * @version         1.0.0
 */

declare(strict_types=1);

$finder = new PhpCsFixer\Finder();
$finder->in(__DIR__ . '/src/');

$config = new PhpCsFixer\Config();
$config->setRules(TaskoProducts\Codestyle\PhpCsFixer::getRules());
$config->setFinder($finder);

return $config;
