{if isset($error)}
<div class="text-center alert alert-danger" role="alert">
    <strong>{$error}</strong>
</div>
{/if}
{if isset($message)}
<div class="text-center alert alert-info" role="alert">
    <strong>{$message}</strong>
</div>
{/if}