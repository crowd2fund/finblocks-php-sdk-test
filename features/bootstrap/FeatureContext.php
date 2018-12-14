<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Then PHP version needs to be :version or later
     *
     * @param string $version
     */
    public function phpVersionNeedsToBeOrLater(string $version)
    {
        if (!version_compare(phpversion(), $version, '>=')) {
            throw new \RuntimeException('Invalid PHP version');
        }
    }
}
