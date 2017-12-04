<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=700px" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <title></title>
	<link rel="stylesheet" type="text/css" href="themes/default/css/style.css">
</head>
<body>
<div class="header">
	{$_header}
</div>

{load_templates "menu.tpl"}

<div class="navigation">
	<ul>
		{menu $navigation}
	</ul>

</div>
<div class="content">
	<h1>{$title}</h1>
	<div class="content__text">{$content}</div>
</div>
<div class="footer">
	{$_footer}
</div>
</body>
</html>