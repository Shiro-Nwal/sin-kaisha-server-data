<!-- Elements/modal_password_edit -->
<?php
$view	= $this;
$helper = $project;

if (!$helper instanceof ProjectHelper)	throw new RuntimeException(__DIR__ . ':' . __FILE__ . ':' . __LINE__);

$urlUserPassEditsIndex = $helper->getUrlUserPassEditsIndex();

/**/
?>
<div id="top-password-edit" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<!-- closeボタン -->
				<h4 class="modal-title"><?php echo h(__('Password Edit')); ?></h4>
			</div>
			<div class="modal-body">
				<div class="form-box">
					<div class="register-form"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn" data-dismiss="modal">Cansel</button>
			</div>
		</div>
	</div>
</div>
<script>(function($){
	var elCallLink	= 'a[href=#top-password-edit][data-toggle=modal]';
	var elFormDiv	= '#top-password-edit div.register-form';
	var loading		= '<p><?php echo h(__('Now Loading')); ?></p>';
	var url			= '<?php echo $urlUserPassEditsIndex; ?>';
	
	var ajaxSubmit = function(r, t, x) {
		
		$(elFormDiv).find('a').click(function() {
			var url = $(this).attr('href');
			$(elFormDiv).load(url, ajaxSubmit);
			return false;
		});
		
		$(elFormDiv).find('form').submit(function(){
			var url = $(this).attr('action');
			var data = new FormData(this);
			
			$.ajax({
				url: url,
				type: 'post',
				data: data,
				dataType: 'html',
				processData: false,
				contentType: false,
				beforeSend: function(x) {
					$(this).find(':input').attr('disabled', 'disabled');
					$(this).find(':input').css({opacity: 0.5});
				},
				error: function(x, t, e) {
					alert('System Error');
					var tmp = location.href;
					location.href = tmp;
				},
				success: function(d, t, x) {
					$(elFormDiv).html(d);
					ajaxSubmit();
				}
			});
			return false;
		});
	};
	
	$(elCallLink).click(function(){
		$(elFormDiv).html(loading);
		$(elFormDiv).load(url, ajaxSubmit);
	});
	
})(jQuery);</script>
<style>
	#top-password-edit .message {
		font-size: 2em;
		color: red;
	}
	
	#top-password-edit .error-message {
		color: red;
	}
	
	#top-password-edit .register-form table {
		margin-top: 20px;
		margin-left: 20px;
	}
	
	#top-password-edit .register-form table th {
		width: 250px;
		height: 30px;
	}
	
	#top-password-edit .register-form table td input {
		width: 300px;
	}
	
	#top-password-edit .register-form table td input[type=submit] {
		width: 100px;
	}
</style>