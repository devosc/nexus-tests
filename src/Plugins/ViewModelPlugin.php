<?php
/**
 *
 */

namespace Mvc5\Test\Plugins;

use Mvc5\Plugins\Service;
use Mvc5\Plugins\ViewModel as _ViewModel;

class ViewModelPlugin
{
    /**
     *
     */
    use Service;
    use _ViewModel {
        layout as public;
        model as public;
        view as public;
    }
}
