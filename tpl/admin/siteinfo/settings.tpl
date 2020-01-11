{include file="elib:/admin/admin_header.tpl"}


<div class="cms-actions form-group">
  <a class="btn btn-sm btn-primary" href="http://{$WEB_ROOT}{$PUBLIC_DIR}/admin/settings/cache">Cache</a>
</div>

{if sizeof($errors)}
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>
    {foreach from=$errors item=e}
        <p>{$e}</p>
    {/foreach}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
{/if}

<h4>SEO Settings</h4>
<form action="" method="post">
    <div class="form-group">
        <label for="title">Page Title:</label>
        <input name="title" type="text" class="form-control" id="title" value="{$settings->title}">
    </div>
    <div class="form-group">
        <label for="keywords">Keywords:</label>
        <textarea name="keywords" class="form-control raw" id="keywords" rows="3">{$settings->keywords}</textarea>
    </div>
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" class="form-control raw" id="description" rows="3">{$settings->description}</textarea>
    </div>
    <button type="submit" name="save" class="btn btn-primary">Save</button>
    <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
</form>

<p>&nbsp;</p>

{include file="elib:/admin/admin_footer.tpl"}