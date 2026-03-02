<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\GlueBackendApiApplicationAuthorizationConnector\Business\Processor\ProtectedPathAuthorization\Checker;

use Generated\Shared\Transfer\AuthorizationRequestTransfer;
use Generated\Shared\Transfer\RouteTransfer;

interface ProtectedPathAuthorizationCheckerInterface
{
    public function authorize(AuthorizationRequestTransfer $authorizationRequestTransfer): bool;

    public function isProtected(RouteTransfer $routeTransfer): bool;
}
