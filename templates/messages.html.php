{if isset($error)}
    <div class="text-center alert alert-danger messages" role="alert">
        <strong>{$error}</strong>
    </div>
    {/if}
    {if isset($message)}
    <div class="text-center alert alert-info messages" role="alert">
        <strong>{$message}</strong>
    </div>
{/if}