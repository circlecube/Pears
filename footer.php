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
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/CodeMirror-2.21/lib/codemirror.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/CodeMirror-2.21/mode/less/less.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/CodeMirror-2.21/mode/css/css.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/CodeMirror-2.21/mode/xml/xml.js"></script>

<script>
$(document).ready(function() { 
	// update rendered pattern when user edits the textareas
	$('#markup textarea').live('keyup', function(e) {
		html_editor.save();
		$('#pattern-wrap').html($('#html-code').val());
	});
	$('#prestyle textarea').live('keyup', function(e) {
		less_editor.save();
		//process the less content into css, 
		var less_data = $('#less-code').val();
		try{
			new(less.Parser)().parse(less_data, function (e, tree) {
			
    		
				var css_data = tree.toCSS();
				//copy it into the css textarea and
				if (css_data != "") {
					$('#style textarea').val(css_data);
					css_editor.setValue(css_data);
					//copy it into the css textarea and apply the styles.
					$('div.main style').html($('#css-code').val());
					
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
		css_editor.save();
		$('div.main style').html($('#css-code').val());
	});
	

	// auto-select code in textarea when clipboard icon is clicked
	$('#markup a.clip').click(function(){
		html_editor.setSelection({line:0,ch:0}, {line:html_editor.lineCount(), ch:null});
		html_editor.focus();
		return false;
	});
	$('#prestyle a.clip').click(function(){
		less_editor.setSelection({line:0,ch:0}, {line:less_editor.lineCount(), ch:null});
		less_editor.focus();
		return false;
	});
	$('#style a.clip').click(function(){
		css_editor.setSelection({line:0,ch:0}, {line:css_editor.lineCount(), ch:null});
		css_editor.focus();
		return false;
	});

	//code hinting
	var css_editor = CodeMirror.fromTextArea(document.getElementById("css-code"), {mode: 'css', lineWrapping: true, lineNumbers: true});
	var less_editor = CodeMirror.fromTextArea(document.getElementById("less-code"), {mode: 'less', lineWrapping: true, lineNumbers: true});
	var html_editor = CodeMirror.fromTextArea(document.getElementById("html-code"), {mode: 'xml', lineWrapping: true, lineNumbers: true});
	
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
