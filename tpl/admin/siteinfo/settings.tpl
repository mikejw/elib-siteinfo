{include file="elib:/admin/admin_header.tpl"}



<div class="grey_top">
<div class="top_right">
<div class="top_left"></div>
</div>
</div>

<div class="grey">

{if sizeof($errors) > 0}
<ul id="error">
{foreach from=$errors item=error}
<li>{$error}</li>
{/foreach}
</ul>
{/if}

<form action="" method="post">
<fieldset>
<legend>Site Settings</legend>
<p>
<label>Default Page Title</label>
<input type="text" name="title" value="{$settings->title}" />
</p>

<p><label>Keywords</label>
<textarea class="raw" rows="0" cols="0" name="keywords">{$settings->keywords}</textarea>
</p>

<p>
<label>Default Site Description</label>
<textarea class="raw" rows="0" cols="0" name="description">{$settings->description}</textarea>
</p>


<p>
<label>&nbsp;</label>
<input type="hidden" name="id" value="{$blog->id}" />
<!--<input type="submit" name="save" value="Save" />-->
<button type="submit" name="save">Save</button>
<button type="submit" name="cancel">Cancel</button>
</p>
</fieldset>
</form>

</div>
<div class="grey_bottom">
<div class="bottom_right">
<div class="bottom_left"></div>
</div>
</div>



{include file="elib:/admin/admin_footer.tpl"}