	<meta http-equiv="Content-Type" content="text/html; charset= ISO-8859-1" />
	<meta http-equiv="imagetoolbar" content="no" />
	<title>{$title}</title>
	{foreach from=$js_file item= link}
	<script type="text/javascript" src="{$link}"></script> 
	{/foreach}
	{foreach from=$css_file item=link}
	
	<link href="{$link}" rel="stylesheet" type="text/css" media="screen" />
	{/foreach} 
	