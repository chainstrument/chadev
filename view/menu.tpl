    <div class="navbar navbar">
    <div class="navbar-inner">
		<a class="brand" href="#">Application</a>
		<ul class="nav">
		 {foreach from=$myMenu key=lien item=element}
			<li class="divider-vertical"><a href="{$lien}/">{$element|ucfirst}</a></li>
		 {/foreach}
	</ul>
	</div>
	</div>