
<?php wp_footer(); ?>

<script>

	var wprestroot =  '<?php echo esc_url_raw( rest_url() ); ?>';
	var wpnonce = '<?php echo wp_create_nonce( 'wp_rest' ); ?>';


	//updates a post title
	jQuery.ajax( {
	    url: wprestroot + 'wp/v2/posts/1',
	    method: 'POST',
	    beforeSend: function ( xhr ) {
	        xhr.setRequestHeader( 'X-WP-Nonce', wpnonce );
	    },
	    data:{
	        'title' : 'Hello Moon yoyoyoyoy'
	    }
	} ).done( function ( response ) {
	    console.log( response );
	} );

	//get title of author first post
	jQuery.ajax( {
	    url: wprestroot + 'myplugin/v1/author/1',
	    method: 'POST',
	    beforeSend: function ( xhr ) {
	        xhr.setRequestHeader( 'X-WP-Nonce', wpnonce );
	    },
	    data:{
	        'postid' : 94
	    }
	} ).done( function ( response ) {
	    console.log( response );
	} );

</script>

</body>
</html>