<aside class="apblog-related">
	<h2 class="apblog-related-title"><span>RELATED</span></h2>
	<ul class="apblog-related-inner">
	<?php
	$categories = get_the_category($post->ID);
	$category_ID = array();

	foreach($categories as $category){
	array_push($category_ID,$category->cat_ID);
	}

	$posts_number = 4; // 表示したい件数を指定

	$args = array(
		'post__not_in'=>array($post->ID), // 現在のページの投稿を除外
		'category__in'=>$category_ID, // 現在の投稿のカテゴリーの関連記事を取得
		'orderby'=>'rand', // ランダムに並べる
		'posts_per_page'=>$posts_number, // 表示する件数の指定
	);
	$wp_query = new WP_Query($args);

	if($wp_query->have_posts()){
	while($wp_query->have_posts()):$wp_query->the_post();
	?>
		<li class="related-block">
			<a href="<?php the_permalink(); ?>">
			<div class="related-thumb"><?php the_post_thumbnail(); ?></div>
			<h2 class="related-title"><?php the_title(); ?></h2>
			<div class="related-desc"><?php the_excerpt(); ?></div>
			</a>
		</li>
	<?php
	endwhile;
	}else{
	?>
		<p>関連する記事はございません</p>
	<?php } ?>
	</ul>
</aside>