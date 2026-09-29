
<footer class="site-footer">
	<div class="container footer-about-us">
		© {{ __('misc.copyright', ['year' => date('Y')]) }}
        <div class="about-us">
            <p class="about-us-p">Over ons:</p>
            <p>downloadyourmanual@email.com</p>
            <p>06 12345678</p>
            <div class="footer-socials">
                <a href="twitter.com"><img src="{{ asset('img/twitter.svg') }}" alt="Twitter"></a>
                <a href="facebook.com"><img src="{{ asset('img/facebook.svg') }}" alt="Facebook" class="facebook-logo"></a>
            </div>
        </div>
	</div>
</footer>


<!-- analytics code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-30506707-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- Einde analytics code -->

<script language="Javascript" type="text/javascript">

 if (top.location!= self.location) {
  top.location = self.location.href
 }

</script>
