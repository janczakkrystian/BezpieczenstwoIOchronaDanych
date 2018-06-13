{if isset($error)}
    <div class="text-center alert alert-danger messages" role="alert" style="margin-bottom: 39px">
        <strong>{$error}</strong>
    </div>
    {/if}
    {if isset($message)}
    <div class="text-center alert alert-info messages" role="alert" style="margin-bottom: 39px">
        <strong>{$message}</strong>
    </div>
{/if}