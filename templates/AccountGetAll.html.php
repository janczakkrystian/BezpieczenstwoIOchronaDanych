{extends file="templates/globalTemplate.html.php"}
{block name="body"}

    <div class="panel-heading">
        <div class="panel-title text-center">
            <h1 class="title">Hasła</h1>
        </div>
		{if $accounts|@count === 0}
			<div class="alert alert-danger" role="alert">Brak haseł w bazie, dodaj hasła!</div>
		{else}
        <div class="row">
			<div>
		
			<ul class="socialIcons">
			{foreach $accountsdictionaries as $id => $accountsdictionary}
				
				<li data-path="http://{$smarty.server.HTTP_HOST}{$subdir}index.php?controller=Accounts&action=getByName&id=" class="{$accountsdictionary['Name']}"><a class="#" data-toggle="modal" data-target=".modal"><i class="fa fa-fw fa-{$accountsdictionary['Name']}"></i>{$accountsdictionary['Name']}</a></li>
				
			{/foreach}
				
			</ul>
			{/if}
			</div>
		</div>
		
        <div class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Login</th>
                                    <th>Hasło</th>
                                </tr>
                            </thead>
                            <tbody class="tableBody">

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
			
    </div>
{/block}