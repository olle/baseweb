		<div id="footer">
			<ul>
				<li><a href="/"><?php echo txt('Home') ?></a></li>
				<li><a href="/staff/"><?php echo txt('Staff') ?></a></li>
				<li><a href="/news/"><?php echo txt('News') ?></a></li>
				<li><a href="/baseweb/"><?php echo txt('Admin') ?></a></li>
				<li>
					<?php echo txt('Galleries') ?>
				  <ul>
				  	<?php foreach ($galleries->getGalleries() as $gallery): ?>
						  <li><a href="/galleries/<?php echo $gallery->slug ?>"><?php echo $gallery->title ?></a></li>
						<?php endforeach ?>
				  </ul>
				</li>
			</ul>
		</div>
		<?php Baseweb::getModule('tracking')->track() ?>
    </body>
</html>
