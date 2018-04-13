<label for="plans">[[Membership Plans]]{$var_param}</label>
<select id="plans" name="plans[]" multiple="multiple">
    <option
        {foreach from=$param.plans item=planSaved}
            {if $planSaved == 0}selected{/if}
        {/foreach}
            value="0">[[Not Subscribed]]</option>
    {foreach from=$plans item=plan}
        <option
        {foreach from=$param.plans item=planSaved}
            {if $plan.id == $planSaved}selected{/if}
        {/foreach}
                value="{$plan.id}">{$plan.name}</option>
    {/foreach}
</select>
