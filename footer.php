	<?php get_sidebar(); ?>
</div> <!-- /wrap -->

<div id="pears-footer">
	<p>Pears is handcrafted in Salem, Massachusetts by <a href="http://simplebits.com">SimpleBits</a>.</p>
	<p>LESS addition in Atlanta, Georgia by <a href="http://circlecube.com">circlecube</a>.</p>
	
	<p class="cc">This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons Attribution-NonCommercial-ShareAlike 3.0 Unported License</a>.</p>

	<p><a href="http://simplebits.com" id="sb"><img src="/wp-content/themes/pears/images/sb-black.png" /></a></p>
</div> <!-- /footer -->

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.color.js"></script>

<script>
$(document).ready(function() { 
	// update rendered pattern when user edits the textareas
	$('#markup textarea').live('keyup', function(e) {
		$('#pattern-wrap').html($(this).val());
	});
	$('#prestyle textarea').live('keyup', function(e) {
		//process the less content into css, 
		var less_data = $('#prestyle textarea').val();
		try{
			new(less.Parser)().parse(less_data, function (e, tree) {
			
    		
				var css_data = tree.toCSS();
				//copy it into the css textarea and
				if (css_data != "") {
					$('#style textarea').html(css_data);			
					//copy it into the css textarea and apply the styles.
					$('div.main style').html($('#style textarea').val());
					
					//user feedback
					$('#style').animate( { 'background-color': 'rgba(161, 207, 50, 0.6)' }, {queue:false,  duration:800, complete: function(){
						$('#style').animate( { 'background-color': 'rgba(255, 255, 255, 0.6)' }, {queue:false,  duration:800 });  
					}} );
					$('#prestyle').animate( { 'background-color': 'rgba(255, 255, 255, 0.6)' }, {queue:false,  duration:800 });
					
				}
			else{
				throw(err);
			}
		});
		} catch (err){ 
			//alert(err);
			//user feedback
			$('#prestyle').animate( { 'background-color': 'rgba(114, 11, 9, 0.6)' }, {queue:false,  duration:800 } ); 
		}
		
		
	});
	$('#style textarea').live('keyup', function(e) {
		$('div.main style').html($(this).val());
	});
	
	// auto-select code in textarea when clipboard icon is clicked
	$('#markup a.clip').click(function(){
		$('#markup textarea').select();
		return false;
	});
	$('#prestyle a.clip').click(function(){
		$('#prestyle textarea').select();
		return false;
	});
	$('#style a.clip').click(function(){
		$('#style textarea').select();
		return false;
	});
	
	// expand/collapse side nav
	$('#nav-toggle').click(function() {
		$('body').toggleClass('expanded');
		return false;
	});
}); 
</script>

<!-- c(~) -->
</body>
</html>
