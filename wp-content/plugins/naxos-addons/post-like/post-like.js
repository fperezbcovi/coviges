jQuery(document).ready(function () {
	
	jQuery("body").on("click", ".jm-post-like", function (a) {
		a.preventDefault(), 
		heart = jQuery(this), 
		post_id = heart.data("post_id"), 
		heart.html("<i id='icon-like' class='icon-like'></i><i id='icon-gear' class='icon-gear'></i>"), 
		
		jQuery.ajax({
			type:"post",
			url:ajax_var.url,
			data:"action=jm-post-like&nonce=" + ajax_var.nonce + "&jm_post_like=&post_id=" + post_id,
			success:function (a) {
				if (-1 !== a.indexOf("already")) {
					var b = a.replace("already", "");
					"0" === b && (b = "Like"), heart.prop("title", "Like"), heart.removeClass("liked"), heart.html("<i id='icon-unlike' class='icon-unlike'></i>&nbsp;" + b)
				} else heart.prop("title", "Unlike"), heart.addClass("liked"), heart.html("<i id='icon-like' class='icon-like'></i>&nbsp;" + a)
			}
		})
	});
	
});
