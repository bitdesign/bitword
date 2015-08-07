<div class="footer">
    <span id="TimeShow"></span>
    <?=stripslashes(base64_decode($accstat))?>&copy; BIT1010 2014 All Rights Reserved .  Powered by <a href="http://www.bit1010.com">BITWORD v1.0</a>
    
</div>

<script language="javascript" type="text/javascript">
    window.onload = function(){ 
        document.getElementById("TimeShow").innerHTML = "page loading time "+ (new Date().getTime()-reqTime)/1000 +"s"; 
    } 
</script>
