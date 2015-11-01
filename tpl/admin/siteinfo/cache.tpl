{include file="elib:/admin/admin_header.tpl"}



<div id="operations">
    <div class="grey_top">
        <div class="top_right">
            <div class="top_left"></div>
        </div>
    </div>

    <div class="grey" style="padding:0.5em;">

        <form class="confirm" action="http://{$WEB_ROOT}{$PUBLIC_DIR}/admin/settings/clear_cache" method="get">
        <div><button type="submit" name="clear_cache" value="1">Clear</button></div>
    </form>
</div>

<div class="grey_bottom">
    <div class="bottom_right">
        <div class="bottom_left"></div>
    </div>
</div>

<p>&nbsp;</p>

<div class="grey_top">
<div class="top_right">
<div class="top_left"></div>
</div>
</div>

<div class="grey">


<div id="data">
{foreach from=$cache_data key=k item=data}

<div class="item">
<p><a href="#">{$k}</a></p>
<pre>
{$data}
</pre>
</div>

{/foreach}
</div>

</div>
<div class="grey_bottom">
<div class="bottom_right">
<div class="bottom_left"></div>
</div>
</div>



{include file="elib:/admin/admin_footer.tpl"}