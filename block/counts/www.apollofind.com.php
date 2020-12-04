


<script>
var data = '&r=' + escape(document.referrer)
    + '&n=' + escape(navigator.userAgent)
    + '&p=' + escape(navigator.userAgent)
    + '&g=' + escape(document.location.href);
if (navigator.userAgent.substring(0,1)>'3')
    data = data + '&sd=' + screen.colorDepth
        + '&sw=' + escape(screen.width+'x'+screen.height);
document.write('<a href="http://www.apollofind.com/counter.html" target="_blank" >');
document.write('<img border=0 hspace=0 '+'vspace=0 src="http://www.apollofind.com/counter.php?i=8505' + data + '">');
document.write('</a>');
</script>

</script>
