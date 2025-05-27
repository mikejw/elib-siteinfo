{include file="elib:admin/admin_header.tpl"}


<form class="confirm" action="http://{$WEB_ROOT}{$PUBLIC_DIR}/admin/settings/clear_cache" method="get">
    <div class="cms-actions form-group">
        <button class="btn btn-sm btn-primary" type="submit" name="clear_cache" value="1">Clear</button>
    </div>
</form>


{foreach from=$cache_data key=k item=data}

<p>
    {$k}
</p>
<pre>
<code>
    {$data|escape}
</code>
</pre>

{/foreach}



{include file="elib:admin/admin_footer.tpl"}