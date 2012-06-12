<? if (!$response->Items) exit('No items found'); ?>

<div class="items">
<? foreach ($response->Items->Item as $item): ?>
	<div class="item">
		<div class="image">
			<img src="<? h($item->LargeImage->URL); ?>" height="<? h($item->LargeImage->Height->{'_'}); ?>" width="<? h($item->LargeImage->Width->{'_'}); ?>">
		</div>
		<div class="meta">
<? $artist = $item->ItemAttributes->Artist ? $item->ItemAttributes->Artist : $item->ItemAttributes->Creator->{'_'}; ?>
			<? if($artist): ?><div class="creator"><? h($artist); ?></div><? endif; ?>
			<div class="title"><a href="<? h($item->DetailPageURL); ?>"><? h($item->ItemAttributes->Title); ?></a></div>

<? if ($item->Tracks->Disc->Track): ?>
			<ol class="tracks">
<? foreach ($item->Tracks->Disc->Track as $track): ?>
				<li class="track"><? h($track->{'_'}); ?></li>
<? endforeach; ?>
			</ol>
<? endif; ?>
		</div>
	</div>
<? endforeach; ?>
</div>

<pre><code>
	<? //print_r($response); ?>
</code></pre>
