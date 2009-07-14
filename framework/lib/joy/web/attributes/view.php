<?php

/* (C) 2009 Netology Joy Web Framework, All rights reserved.
 *
 * Author(s):
 *   Hasan Ozgan (meddah@netology.org)
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import("joy.web.Attribute");

class joy_web_attributes_View extends joy_web_Attribute
{
    public function Execute()
    {
        $this->Page->SetViewFileName($this->Values["value"]);
 
        $this->Logger->Debug("Attribute View", __FILE__, __LINE__);
    }
}

?>
