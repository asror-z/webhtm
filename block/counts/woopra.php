<?php

/**@var ZView $this*/
use zetsoft\system\kernels\ZView;

$this->grape = true;

?>



<script>
(function(){
    var t,i,e,n=window,o=document,a=arguments,s="script",r=["config","track","identify","visit","push","call","trackForm","trackClick"],c=function(){var t,i=this;for(i._e=[],t=0;r.length>t;t++)(function(t){i[t]=function(){return i._e.push([t].concat(Array.prototype.slice.call(arguments,0))),i}})(r[t])};for(n._w=n._w||{},t=0;a.length>t;t++)n._w[a[t]]=n[a[t]]=n[a[t]]||new c;i=o.createElement(s),i.async=1,i.src="//static.woopra.com/js/w.js",e=o.getElementsByTagName(s)[0],e.parentNode.insertBefore(i,e)
  })("woopra");

  woopra.config({
      domain: 'eyuf.zetsoft.uz'
  });
  woopra.track();
</script>

<script>
    /* Place this on a template where a customer initially is identified
       or after authentication. (Important: Update these values) */

    woopra.identify({
        //email: "<<YOUR CUSTOMER EMAIL HERE>>",
        name: "<<YOUR CUSTOMER NAME HERE>>",
        company: "<<YOUR CUSTOMER COMPANY HERE>>"
    });

    // The identify code should be added before the "track()" function
    woopra.track();
</script>

<script>
    /* Below is an example of a "payment" event that is sent when
       you process a payment for a customer. */

    woopra.track("payment", {
        amount: "49.95",
        currency: "USD"
    });
</script>

