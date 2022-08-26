<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector;

use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\AuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\DefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Dependency\Facade\GlueBackendApiApplicationAuthorizationConnectorToAuthorizationFacadeInterface;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Processor\AuthorizationValidator\AuthorizationValidator;
use Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Processor\AuthorizationValidator\AuthorizationValidatorInterface;
use Spryker\Glue\Kernel\Backend\AbstractFactory;

/**
 * @method \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\GlueBackendApiApplicationAuthorizationConnectorConfig getConfig()
 */
class GlueBackendApiApplicationAuthorizationConnectorFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Processor\AuthorizationValidator\AuthorizationValidatorInterface
     */
    public function createAuthorizationValidator(): AuthorizationValidatorInterface
    {
        return new AuthorizationValidator(
            $this->getAuthorizationFacade(),
            $this->getConfigExtractorStrategies(),
            $this->getConfig(),
        );
    }

    /**
     * @return \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\Dependency\Facade\GlueBackendApiApplicationAuthorizationConnectorToAuthorizationFacadeInterface
     */
    public function getAuthorizationFacade(): GlueBackendApiApplicationAuthorizationConnectorToAuthorizationFacadeInterface
    {
        return $this->getProvidedDependency(GlueBackendApiApplicationAuthorizationConnectorDependencyProvider::FACADE_AUTHORIZATION);
    }

    /**
     * @return array<\Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface>
     */
    public function getConfigExtractorStrategies(): array
    {
        return [
           $this->createAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(),
           $this->createDefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(),
        ];
    }

    /**
     * @return \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface
     */
    public function createAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(): ConfigExtractorStrategyInterface
    {
        return new AuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy();
    }

    /**
     * @return \Spryker\Glue\GlueBackendApiApplicationAuthorizationConnector\ConfigExtractorStrategy\ConfigExtractorStrategyInterface
     */
    public function createDefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy(): ConfigExtractorStrategyInterface
    {
        return new DefaultAuthorizationStrategyAwareResourceRoutePluginConfigExtractorStrategy();
    }
}
