{extends file="templates/globalTemplate.html.php"}
{block name="body"}
<h1 class="h2 text-center">Zapisane logi</h1>
{if isset($logs) && $logs > 0}
<table class="table">
    <thead class="table-bordered">
        <tr>
            <td class="col-sm-6 col-lg-6 col-md-6">Opis</td>
            <td class="col-sm-3 col-lg-3 col-md-3">Data</td>
            <td class="col-sm-3 col-lg-3 col-md-3">IP komputera</td>
        </tr>
    </thead>
    <tbody>
    {foreach $logs as $log}
        <tr>
            <td>{$log[\Config\Database\DBConfig\Log::$Description]}</td>
            <td>{$log[\Config\Database\DBConfig\Log::$Date]}</td>
            <td>{$log[\Config\Database\DBConfig\Log::$IP]}</td>
        </tr>
    {/foreach}
    </tbody>
</table>
{else}
<p class="h4 text-center text-info">Brak logów!</p>
{/if}
{/block}