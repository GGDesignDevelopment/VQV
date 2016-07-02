<div id="wrapper">
	<article id="texto">
		<h1><?php echo $page->titulo?></h1>
		<p>
			<?php echo $page->texto?>
		</p>
	</article>
	<div id="makeMeScrollable">
		<?php foreach ($fotos as $foto) {?>
			<a class="slide" href="<?php echo $foto['href'];?>"><img src="<?php echo $foto['src'];?>" alt="Boudoir" /></a>		
		<?php }?>
	</div>
</div>