<?php global $bp; ?>
<div class="activity-content">
	<?php bp_activity_content_body(); ?>
</div>
<?php $attach_id = (int) bp_activity_get_meta( bp_get_activity_id(), 'reality_photo' ); ?>
<?php $full_image_src = wp_get_attachment_image_src( $attach_id, 'full' ); ?>
<?php $image_src = wp_get_attachment_image_src( $attach_id, 'width=700&height=700&crop=1' ); ?>

<div class="photo-blog-photo">
	<a href="<?php echo $full_image_src[0]; ?>" rel="fancybox">
	
		<img src="<?php echo $image_src[0] ?>" alt="Reality Image" />
	</a>
</div>