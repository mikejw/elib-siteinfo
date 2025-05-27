{include file="elib:admin/admin_header.tpl"}


<div class="cms-actions form-group">
  <a class="btn btn-sm btn-primary" href="http://{$WEB_ROOT}{$PUBLIC_DIR}/admin/settings/cache">Cache</a>
</div>

{if isset($errors) and sizeof($errors)}
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

    {foreach from=$settings_available item=name}
      <div class="form-group">
          <label for="{$name}">{$name}:</label>

          {if preg_match('/description/', $name)}
            <textarea name="{$name}" class="form-control raw" id="{$name}" rows="3">{$settings->$name}</textarea>
          {else}
            <input name="{$name}" type="text" class="form-control" id="{$name}" value="{$settings->$name}">
          {/if}
      </div>
    {/foreach}

    <button type="submit" name="save" class="btn btn-primary">Save</button>
    <button type="submit" name="cancel" class="btn btn-primary">Cancel</button>
</form>

<p>&nbsp;</p>

{include file="elib:admin/admin_footer.tpl"}